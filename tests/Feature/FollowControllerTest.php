<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\Following;
use App\Models\School;
use App\Models\Review;
use App\Models\User;
use Mockery\MockInterface;

class FollowControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $school;
    private $review;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->school = School::factory()->create();
        $this->review = Review::factory(['user_id' => $this->user, 'school_id' => $this->school])->create();
    }

    /**
     * getCurrentStatus()メソッドが機能することをテスト
     */
    public function test_canGetCurrentStatus()
    {
        // Reviewモデルのfind()メソッドをモック
        $mock = $this->partialMock(Review::class, function (MockInterface $mock) {

            $review = Review::factory([
                'id' => 1,
                'follows' => collect([
                    (object)['user_id' => $this->user->id, 'review_id' => 1],
                    (object)['user_id' => $this->user->id + 1, 'review_id' => 1],
                    (object)['user_id' => $this->user->id + 2, 'review_id' => 1],
                ]),
            ])->make();

            $mock->shouldReceive('find')->once()->andReturn($review);
        });

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get('/follow/1');

        $response->assertJson(['bool' => true, 'count' => 3]);
    }

    /**
     * フォローしていないレビューをフォロー出来て、
     * フォロワー数が更新されることをテスト
     * @test
     * @return void
     */
    public function フォロー前のレビューをフォロー出来る()
    {
        // Reviewモデルのfind()メソッドをモック
        $mock = $this->partialMock(Review::class, function (MockInterface $mock) {

            $mock->shouldReceive('find')->once()->andReturn($this->review);
        });

        // レビュー投稿者とは別のユーザーを作成
        $current_user = User::factory()->create();
        Auth::login($current_user);

        $response = $this->actingAs($current_user)->postJson('/follow', ['reviewId' => $this->review->id]);

        $response->assertJson(['bool' => true, 'count' => 1, 'flash' => 'レビューをフォローしました！']);
    }
}
