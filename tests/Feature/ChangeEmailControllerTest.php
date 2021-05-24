<?php

namespace Tests\Feature;

use Mockery\MockInterface;
use App\Models\EmailReset;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\ChangeEmail;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Tests\TestCase;

class ChangeEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected $emailResetMock;

    /**
     * テスト前のデータを用意
     * @retun void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->emailResetMock = Mockery::mock(EmailReset::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * メールアドレス変更フォームが表示されることをテスト
     * @return void
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

        $new_email = 'example@gmail.com';

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => $new_email]);

        $this->assertDatabaseHas('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', '確認メールを送信しました。');
        
        // 指定するユーザーに通知が送信されたことをアサート
        Notification::assertSentTo(
            EmailReset::latest()->first(), ChangeEmail::class
        );

        //データベースからユーザーのメールアドレス変更用トークンを取得
        $token = EmailReset::latest()->first()->toArray()['token'];

        //送信されたメール内のリンクにトークンを渡してアクセス
        $response = $this->actingAs($this->user)->get('/email/reset/' . $token);

        //メールアドレスが変更されたかデータベースを確認
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'email' =>  $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', 'メールアドレスを更新しました！');
    }

    /**
     * 新しいメールアドレスがバリデーションエラーでリダイレクトされることをテスト
     * @return void
     */
    public function testChangeEmail_異常系_バリデーションエラー()
    {
        Notification::fake();

        Auth::login($this->user);

        $new_email = 'example@gmail.comあいうえお';

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => $new_email]);

        $this->assertDatabaseMissing('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        //バリデーションエラーでリダイレクトされることを確認
        $response->assertStatus(302);
        
        // 通知が送信されたなかったことを確認
        Notification::assertNothingSent();
    }

    /**
     * DBのトランザクション中にエラーが起きてエラーメッセージが表示されることをテスト
     * @return void
     */
    public function testChangeEmail_異常系_DBトランザクションエラー()
    {
        Notification::fake();

        $this->instance(
            EmailReset::class,
            Mockery::mock(EmailReset::class, function (MockInterface $mock) {
                $mock->shouldReceive('create')->andthrow(new \Exception('error'));
            })
        );
        
        Auth::login($this->user);
        
        $new_email = 'example@gmail.com';
        
        $response = $this->actingAs($this->user)->post('/email', ['new_email' => $new_email]);
        
        //データベースにレコードがないことを確認
        $this->assertDatabaseMissing('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        //リダイレクトとエラーメッセージが表示されることを確認
        $response->assertRedirect('/users')->assertSessionHas('flash_message', 'メール更新に失敗しました。');
        
        // 通知が送信されたなかったことを確認
        Notification::assertNothingSent();
    }  

    /**
     * email_resetsに存在しないトークンを送信してエラーになることをテスト
     * @return void
     */
    public function testChangeEmail_異常系_存在しないトークンを送信()
    {
        Notification::fake();

        Auth::login($this->user);

        $new_email = 'example@gmail.com';

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => $new_email]);

        $this->assertDatabaseHas('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', '確認メールを送信しました。');
        
        // 指定するユーザーに通知が送信されたことをアサート
        Notification::assertSentTo(
            EmailReset::latest()->first(), ChangeEmail::class
        );

        //email_resetsに登録されたトークンとは違うトークンを生成
        $wrongToken = 'wrongtoken';

        //送信されたメール内のリンクに間違ったトークンを渡してアクセス
        $response = $this->actingAs($this->user)->get('/email/reset/' . $wrongToken);

        //データベースからレコードが削除されることを確認
        $this->assertDatabaseMissing('users', ['id' => $this->user->id, 'email' =>  $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', 'メールアドレスの更新に失敗しました。');
    }

    /**
     * トークンの有効期限が切れてエラーになることをテスト
     * @return void
     */
    public function testChangeEmail_異常系_有効期限の切れたトークン()
    {
        Notification::fake();

        Auth::login($this->user);

        $new_email = 'example@gmail.com';

        $response = $this->actingAs($this->user)->post('/email', ['new_email' => $new_email]);

        $this->assertDatabaseHas('email_resets', ['user_id' => $this->user->id, 'new_email' => $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', '確認メールを送信しました。');
        
        // 指定するユーザーに通知が送信されたことをアサート
        Notification::assertSentTo(
            EmailReset::latest()->first(), ChangeEmail::class
        );

        //データベースからユーザーのメールアドレス変更用トークンを取得
        $token = EmailReset::latest()->first()->toArray()['token'];

        //トークンがデータベースに保存されてから1時間経ったとする
        $this->travel(1)->hours();

        //送信されたメール内のリンクにトークンを渡してアクセス
        $response = $this->actingAs($this->user)->get('/email/reset/' . $token);

        //データベースからレコードが削除されることを確認
        $this->assertDatabaseMissing('users', ['id' => $this->user->id, 'email' =>  $new_email]);

        $response->assertRedirect('/users')->assertSessionHas('flash_message', 'メールアドレスの更新に失敗しました。');
    }
}