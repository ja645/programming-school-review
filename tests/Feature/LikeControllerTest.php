<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\School;
use App\Models\User;
use Mockery\MockInterface;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;    
    private $school;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->school = School::factory()->create();
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
    
    /**
     * いいねしていないスクールをいいね出来て、
     * いいね数が1増えることをテスト
     * @test
     * @return void
     */
    public function いいね前のスクールをいいね出来る()
    {
        $number_of_likes = $this->school->likes->count();

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->post('/like', ['schoolId' => $this->school->id]);

        $response->assertJson(['bool' => true, 'count' => $number_of_likes + 1, 'flash' => 'スクールをいいねしました！']);
    }


    /**
     * いいね済みのスクールをいいね解除出来て、
     * いいね数が1減ることをテスト
     * @test
     * @return void
     */
    public function いいね済みのスクールをいいね解除出来る()
    {
        // $this->userが$this->schoolを既にいいねしている状態を作成
        Like::create([
            'user_id' => $this->user->id, 'school_id' => $this->school->id,
        ]);

        $number_of_likes = $this->school->likes->count();

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->post('/like', ['schoolId' => $this->school->id]);

        $response->assertJson(['bool' => false, 'count' => $number_of_likes - 1, 'flash' => 'いいねを解除しました。']);
    }
}
