<?php

namespace Tests\Feature;

use App\Models\User;
use App\Http\Requests\UserFormRequest;
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
     * データプロバイダを使って成功時と失敗時を検証するようにしたい
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

    public function testUpdate()
    {
        $user = User::factory()->create();

        $userId = $user->id;

        $editedUser = [
            'id' => $userId,
            'user_name' => '山本 次郎',
            'birthday' => '2004-9-30 00:00:00.000000',
            'sex' => 1,
            'former_job' => 'ニート',
            'job' => 'フリーター',
            'school_id' => 2,
        ];

        $response = $this->actingAs($user)->patch('/users/update', $editedUser);

        $this->assertDatabaseHas('users', $editedUser);

        $response->assertRedirect('users');
    }
}
