<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    /**
     * 管理者用ログインページが表示されることをテスト
     *
     * @return void
     */
    public function test_can_show_login_form()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200)->assertViewIs('admin.login');
    }

    /**
     * ユーザーが指定されたユーザーIDとパスワードで
     * 管理者としてログインできることをテスト
     * 
     * @return void
     */
    public function test_can_users_login_as_administrator()
    {
        $response = $this->post('admin/login', [
            'user_id' => 'hoge',
            'password' => 'fuga'
        ]);

        $response->assertRedirect(route('school-list'))->assertSessionHas('admin_auth', true);
    }

    /**
     * ユーザーIDが違うことでログイン出来ないことをテスト
     * 
     * @return void
     */
    public function test_users_can_not_login_with_wrong_user_id()
    {
        $response = $this->post('admin/login', [
            'user_id' => 'wrong user id',
            'password' => 'fuga'
        ]);

        $response->assertRedirect(route('admin.login'))->assertSessionHas(['admin_auth' => false, 'flash_message' => 'ユーザーIDまたはパスワードが違います。']);
    }

    /**
     * パスワードが違うことでログイン出来ないことをテスト
     * 
     * @return void
     */
    public function test_users_can_not_login_with_wrong_password()
    {
        $response = $this->post('admin/login', [
            'user_id' => 'hoge',
            'password' => 'wrong password'
        ]);

        $response->assertRedirect(route('admin.login'))->assertSessionHas(['admin_auth' => false, 'flash_message' => 'ユーザーIDまたはパスワードが違います。']);
    }

    /**
     * 管理者としてログイン済みのユーザーがログアウト出来ることをテスト
     * 
     * @return void
     */
    public function test_administrators_can_logout()
    {
        $response = $this->withSession(['admin_auth' => true])
                    ->post(route('admin.logout'));

        $response->assertRedirect(route('top'))->assertSessionMissing('admin_auth');
    }

    /**
     * 管理者としてログイン前のユーザーがログアウトしようとすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administrators_can_not_logout()
    {
        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
    }
}
