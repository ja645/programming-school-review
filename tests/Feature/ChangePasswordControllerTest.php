<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangePasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * パスワード変更ページが表示されることをテスト
     * @return void
     */
    public function testCanRedirectPasswordEdit()
    {
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get('/password/edit');

        $response->assertStatus(200)->assertViewIs('auth.user.editPassword');
    }

    /**
     * ログイン前にパスワード変更ページにアクセスするとログインページにリダイレクトされることをテスト
     * @return void
     */
    public function testCanRedirectPasswordEdit_異常系_未ログイン()
    {
        $response = $this->get('/password/edit');

        $response->assertRedirect('login');
    }

    /**
     * パスワードの変更が成功することをテスト
     * @return void
     */
    public function testUpdatePassword_正常系()
    {
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->patch('/password', [
            //factoryで作られたユーザーはパスワードの値が'password1'
            'current_password' => 'password1', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'
        ]);

        //ユーザーのパスワードが指定の値に変更されているか検証
        $this->assertTrue(Hash::check('password2', User::find($this->user->id)->password));

        $response->assertStatus(200)->assertViewIs('auth.user.mypage');
    }

    /**
     * 認証されていないユーザーのアクセスでログインページにリダイレクトされることをテスト
     * @return void
     */
    public function testUpdatePassword_異常系_認証されていないユーザー()
    {
        $response = $this->patch('/password', [
            //factoryで作られたユーザーはパスワードの値が'password1'
            'current_password' => 'password1', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'
        ]);

        //ユーザーのパスワードが指定の値に変更されていないことを検証
        $this->assertFalse(Hash::check('password2', User::find($this->user->id)->password));

        $response->assertRedirect('login');
    }

    /**
     * 確認用のパスワードが一致せず、パスワードの更新が失敗することをテスト
     * @return void
     */
    public function testUpdatePassword_異常系_確認用パスワードの不一致()
    {
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->patch('/password', [
            //factoryで作られたユーザーはパスワードの値が'password1'
            'current_password' => 'password1', 'new_password' => 'password2', 'new_password_confirmation' => 'password3'
        ]);

        //ユーザーのパスワードが指定の値に変更されていないことを検証
        $this->assertFalse(Hash::check('password2', User::find($this->user->id)->password));
        
        $response->assertStatus(302);
    }
}
