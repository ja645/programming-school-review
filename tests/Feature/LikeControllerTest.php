<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\Likes;
use App\Models\School;
use App\Models\User;
use Mockery\MockInterface;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * getCurrentStatus()メソッドが機能することをテスト
     */
    public function test_canGetCurrentStatus()
    {
        // Reviewモデルのfind()メソッドをモック
        $mock = $this->partialMock(School::class, function (MockInterface $mock) {

            $school = School::factory([
                'id' => 1,
                'likes' => collect([
                    (object)['user_id' => $this->user->id],
                    (object)['user_id' => $this->user->id + 1],
                    (object)['user_id' => $this->user->id + 2],
                ]),
            ])->make();

            $mock->shouldReceive('find')->once()->andReturn($school);
        });

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get('/like/1');

        $response->assertJson(['bool' => true, 'count' => 3]);
    }       
}
