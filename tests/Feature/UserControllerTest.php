<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー登録フォームにアクセス出来るかテスト
     *
     * @return void
     */
    public function testAdd()
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
    }

    /**
     * ユーザーの新規作成をテスト
     * @return void
     */
    public function testCreate()
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
        $response->assertRedirect('top');
    }

    /**
     * ユーザー編集フォームにアクセス出来るかテスト
     * 
     * @return void
     */
    public function testEdit()
    {   
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/users/edit');

        $response->assertStatus(200);
    }

    /**
     * ユーザーの更新が成功することをテスト
     * 
     * @return void
     */
    // public function testUpdate_正常系()
    // {
    //     Auth::login($user = User::factory()->create());

    //     $editedForm = [
    //         'user_name' => '山本 次郎',
    //         'birthday' => '2004-9-30 00:00:00.000000',
    //         'sex' => 1,
    //         'former_job' => 'ニート',
    //         'job' => 'フリーター',
    //         'school_id' => 2,
    //     ];

    //     $response = $this->actingAs($user)->patch('/users/update', $editedForm);

    //     $this->assertDatabaseHas('users', $editedForm);

    //     $response->assertRedirect('users');
    // }

    /**
     * ログイン前のユーザーのアクセスに対してログインページにリダイレクトすることをテスト
     * 
     * @return void
     */
    // public function testUpdate_異常系_未ログイン()
    // {
    //     $editedForm = [
    //         'user_name' => '山本 次郎',
    //         'birthday' => '2004-9-30 00:00:00.000000',
    //         'sex' => 1,
    //         'former_job' => 'ニート',
    //         'job' => 'フリーター',
    //         'school_id' => 2,
    //     ];

    //     $response = $this->patch('/users/update', $editedForm);

    //     $this->assertDatabaseMissing('users', $editedForm);

    //     $response->assertRedirect('login');
    // }

    /**
     * リクエストに不適切なフィールドがあれば403を返すことをテスト
     * 
     * @return void
     */
    public function testUpdate_異常系_不適切なリクエスト()
    {
        Auth::login($user = User::factory()->create());

        $editedForm = [
            'bad_request' => 'bad',
            'user_name' => '山本 次郎',
            'birthday' => '2004-9-30 00:00:00.000000',
            'sex' => 1,
            'former_job' => 'ニート',
            'job' => 'フリーター',
            'school_id' => 2,
        ];

        $resultForm = [
            'user_name' => '山本 次郎',
            'birthday' => '2004-9-30 00:00:00.000000',
            'sex' => 1,
            'former_job' => 'ニート',
            'job' => 'フリーター',
            'school_id' => 2,
        ];

        $response = $this->actingAs($user)->patch('/users/update', $editedForm);

        $this->assertDatabaseMissing('users', $resultForm);

        $response->assertRedirect(403);
    }
}
