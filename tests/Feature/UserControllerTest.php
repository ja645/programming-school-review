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
     * 
     *
     * @return void
     */
    public function testAdd()
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
    }

    /**
     *ユーザーの新規作成をテスト
     * 
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

        $response = $this->post('/users', $user);

        $this->assertAuthenticated();
        $response->assertRedirect('top');
    }
}
