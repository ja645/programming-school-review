<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
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

        $this->user = Auth::login(User::factory()->create());
    }

    /**
     * パスワード変更ページが表示されることをテスト
     * @return void
     */
    public function testCanRedirectPasswordEdit()
    {
        $response = $this->actingAs($this->user)->get('/password/edit');

        $response->assertRedirct('auth.password.edit');
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
     * @test
     * @return void
     */
    public function testUpdatePassword_正常系()
    {
        $response = $this->actingAs($this->user)->patch('/password', [
            'password' => 'password2', 'new_password_confirmation' => 'password2'
        ]);

        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'password' => 'password2']);

        $response->assertRedirect('auth.users');
    }
}
