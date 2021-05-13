<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeControllerTest extends TestCase
{
    /**
     * トップページが表示され、ログイン前後でヘッダーの内容が変わることをテスト
     * @return void
     */
    public function test_CanshowTop_ログイン前()
    {
        $response = $this->get('/');

        $response->assertStatus(200)->assertViewIs('layouts.top')->assertSee('ログイン');
    }

    /**
     * トップページが表示され、ログイン前後でヘッダーの内容が変わることをテスト
     * @return void
     */
    public function test_CanshowTop_ログイン後()
    {
        $user = User::factory()->create();

        Auth::login($user);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)->assertViewIs('layouts.top')->assertSee('ログアウト');
    }


    /**
     * お問い合わせページが表示されることをテスト
     * @return void
     */
    public function test_canShowContactForm()
    {
        $response = $this->get('/contacts');

        $response->assertStatus(200)->assertViewIs('layouts.contact');
    }

    /**
     * お問い合わせ送信後の処理が完了することをテスト
     */
    public function test_succeedInReceiveContact()
    {
        $user = User::factory()->create();

        Auth::login($user);

        $contact_form = [
            'name' => 'test',
            'have_acount' => 1,
            'email' => 'sample@example.com',
            'title' => 'test',
            'inquiry' => 'test',
        ];

        $response = $this->actingAs($user)->post('/contacts', $contact_form);

        $response->assertStatus(200)->assertViewIs('layouts.contact.success');
    }
}
