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
    private $poster;
    private $school;
    private $review;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // レビューの投稿者を用意
        $this->poster = User::factory()->create();

        // 現在のユーザーを用意
        $this->user = User::factory()->create();

        // レビューの対象のスクールを用意
        $this->school = School::factory()->create();

        // レビューを用意
        $this->review = Review::factory(['user_id' => $this->poster, 'school_id' => $this->school])->create();
    }

    /**
     * getCurrentStatus()メソッドが機能することをテスト
     * @return void
     */
    public function test_canGetCurrentStatus()
    {
        // Reviewモデルのfind()メソッドをモック
        $mock = $this->partialMock(Review::class, function (MockInterface $mock) {

            // $this->userがすでにレビューをフォローしていて、フォロワー数が3の状態を作成
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
     * フォロワー数が1増えることをテスト
     * @test
     * @return void
     */
    public function フォロー前のレビューをフォロー出来る()
    {
        $number_of_followers = $this->review->follows->count();

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->post('/follow', ['reviewId' => $this->review->id]);

        $response->assertJson(['bool' => true, 'count' => $number_of_followers + 1, 'flash' => 'レビューをフォローしました！']);
    }


    /**
     * フォロー済みのレビューをフォロー解除出来て、
     * フォロワー数が1減ることをテスト
     * @test
     * @return void
     */
    public function フォロー済みのレビューをフォロー解除出来る()
    {
        // $this->userが$this->reviewを既にフォローしている状態を作成
        Following::create([
            'user_id' => $this->user->id, 'review_id' => $this->review->id,
        ]);

        $number_of_followers = $this->review->follows->count();

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->post('/follow', ['reviewId' => $this->review->id]);

        $response->assertJson(['bool' => false, 'count' => $number_of_followers - 1, 'flash' => 'フォローを解除しました。']);
    }

     /**
      * 自分のレビューをフォロー出来ないことをテスト
      * @test
      * @return void
      */
    public function 自分のレビューのフォローに失敗()
    {
        Auth::login($this->poster);

        $response = $this->actingAs($this->poster)->post('/follow', ['reviewId' => $this->review->id]);

        $response->assertJson(['flash' => '自分のレビューはフォロー出来ません。']);
    }
}
