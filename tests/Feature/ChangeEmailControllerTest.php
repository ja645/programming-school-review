<?php

namespace Tests\Feature;

use App\Models\EmailReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\ChangeEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ChangeEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    /**
     * テスト前のデータを用意
     * @retun void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * メールアドレス変更フォームが表示されることをテスト
     */
    public function testShowChangeEmailForm_正常系()
    {
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get('/email/edit');

        $response->assertStatus(200)->assertViewIs('auth.email.edit');
    }

    /**
     * メールアドレス変更用リンクがメール送信され、
     * メール内のリンクにアクセスするとメールアドレスが更新されることをテスト
     * @return void
     */
    public function testChangeEmail_正常系()
    {
        Notification::fake();

        Auth::login($this->user);

        $new_email = 'testtest@gmail.com';

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => 'testtest@gmail.com']);

        $this->assertDatabaseHas('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', '確認メールを送信しました。');
        
        // 指定するユーザーに通知が送信されたことをアサート
        Notification::assertSentTo(
            EmailReset::latest()->first(), ChangeEmail::class
        );

        //データベースからユーザーのメールアドレス変更用トークンを取得
        $token = EmailReset::latest()->first()->toArray()['token'];

        //送信されたメール内のリンクにトークンを渡してアクセス
        $response = $this->actingAs($this->user)->delete('/email/reset', ['token' =>$token]);

        //メールアドレスが変更されたかデータベースを確認
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'email' =>  'testtest@gmail.com']);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', 'メールアドレスを更新しました！');
    }
}