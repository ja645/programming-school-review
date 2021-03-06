<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    /**
     * マイページが表示されることをテスト
     * @return void
     */
    public function testIndex_正常系()
    {
        // Auth::login($user = User::factory()->create());
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get(route('mypage'));

        $response->assertStatus(200)->assertViewIs('auth.user.mypage');
    }

    /**
     * ユーザー登録フォームにアクセス出来るかテスト
     *
     * @return void
     */
    public function testAdd_正常系()
    {
        $response = $this->get('/signup');

        $response->assertStatus(200)->assertViewIs('layouts.user.create');
    }

    /**
     * ユーザーの新規作成をテスト
     * @return void
     */
    public function testCreate_正常系()
    {
        $user = [
            'user_name' => '田中 太郎',
            'birthday' => '2013-5-30 00:00:00.000000',
            'sex' => 2,
            'former_job' => '公務員',
            'job' => 'エンジニア',
            'school_id' => 1,
            'email' => 'test@gmail.com',
            'password' => 'password1',
            'password_confirmation' => 'password1',
        ];

        $response = $this->post('/users/create', $user);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', ['email' => 'test@gmail.com']);

        $response->assertRedirect(route('mypage'))->assertSessionHas('flash_message', '会員登録が完了しました！');
    }

    /**
     * ユーザー編集フォームにアクセスし、編集ページがユーザー情報と共に返ってくるかテスト
     * 
     * @return void
     */
    public function testEdit_正常系()
    {   
        // Auth::login($user = User::factory()->create());
        Auth::login($this->user);
        
        $response = $this->actingAs($this->user)->get('/users/edit');

        $response->assertStatus(200)->assertViewIs('auth.user.edit');

        // $response->assertSee($user->user_name, $user->birthday, $user->sex, $user->former_job, $user->job, $user->school_id);
    }

    /**
     * ログイン前のユーザーのアクセスに対してログインページにリダイレクトすることをテスト
     * 
     * @return void
     */
    public function testEdit_異常系_未ログイン()
    {   
        $response = $this->get('/users/edit');

        $response->assertRedirect('login');
    }

    /**
     * ユーザーの更新が成功することをテスト
     * 
     * @return void
     */
    public function testUpdate_正常系()
    {
        // Auth::login($user = User::factory()->create());
        Auth::login($this->user);

        $editedForm = [
            'user_name' => '山本 次郎',
            'birthday' => '2004-9-30 00:00:00.000000',
            'sex' => 1,
            'former_job' => 'ニート',
            'job' => 'フリーター',
        ];

        $response = $this->actingAs($this->user)->post('/users/update', $editedForm);

        $this->assertDatabaseHas('users', $editedForm);

        $response->assertRedirect(route('mypage'))->assertSessionHas('flash_message', '会員情報の変更が完了しました！');
    }

    /**
     * ログイン前のユーザーのアクセスに対してログインページにリダイレクトすることをテスト
     * 
     * @return void
     */
    public function testUpdate_異常系_未ログイン()
    {
        $editedForm = [
            'user_name' => '山本 次郎',
            'birthday' => '2004-9-30 00:00:00.000000',
            'sex' => 1,
            'former_job' => 'ニート',
            'job' => 'フリーター',
        ];

        $response = $this->post('/users/update', $editedForm);

        $this->assertDatabaseMissing('users', $editedForm);

        $response->assertRedirect('login');
    }

    /**
     * 退会処理が成功することをテスト
     * @return void
     */
    public function testDelete_正常系()
    {
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->delete('/users/delete');

        $this->assertDatabaseMissing('users', ['id' => $this->user->id]);

        $response->assertRedirect(route('top'))->assertSessionHas('flash_message', '退会手続きが完了しました！');
    }

    /**
     * ユーザーの投稿したレビュー一覧が表示されることをテスト
     * @return void
     */
    public function test_canShowMyReview()
    {
        Auth::login($this->user);

        $response = $this->get(route('user.review'));

        $response->assertStatus(200)->assertViewIs('auth.user.myreview');
    }

    /**
     * ユーザーの投稿したレビュー一覧が表示されることをテスト
     * @return void
     */
    public function test_canShowFollowingsList()
    {
        Auth::login($this->user);

        $response = $this->get(route('user.followings'));

        $response->assertStatus(200)->assertViewIs('auth.user.followings-list');
    }

    /**
     * ユーザーの投稿したレビュー一覧が表示されることをテスト
     * @return void
     */
    public function test_canShowLikesList()
    {
        Auth::login($this->user);

        $response = $this->get(route('user.likes'));

        $response->assertStatus(200)->assertViewIs('auth.user.likes-list');
    }
}
