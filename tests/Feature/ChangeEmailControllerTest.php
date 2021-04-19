<?php

namespace Tests\Feature;

use App\Models\EmailReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangeEmailControllerTest extends TestCase
{
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
     * メールアドレス変更用リンクがメール送信されることをテスト
     * @return void
     */
    public function testSendChangeEmailLink_正常系()
    {
        Mail::fake();

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => 'testtest@gmail.com']);

        $response->assertRedirect('/')->assertSee('確認メールを送信しました。');
        Mail::assertSent(OrderShipped::class);
    }

    /**
     * 送信されたメール内のリンクからメールアドレスの変更に成功することをテスト
     * @return void
     */
    public function testResetEmail_正常系()
    {
        Auth::login($this->user);

        //データベースからユーザーのメールアドレス変更用トークンを取得
        $token = EmailReset::where('user_id', $this->user->id)->select('token')->first()->toArray()['token'];

        //送信されたメール内のリンクにトークンを渡してアクセス
        $response = $this->actingAs($this->user)->get('/email/reset/' . $token);

        //メールアドレスが変更されたかデータベースを確認
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'email' =>  'testtest@gmail.com']);

        $response->assertStatus(200)->assertRedirect('auth.user.mypage');
    }
}
