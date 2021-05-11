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

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    // /**
    //  * 認証済みのユーザーが他のユーザーのレビューをフォローできることをテスト
    //  * @return void
    //  */
    // public function testFollow_正常系(): void
    // {
    //     Auth::login($this->myself);

    //     $response = $this->actingAs($this->myself)->post('/follow', [
    //         'followed_review_id' => $this->review->id
    //     ]);

    //     $this->assertDatabaseHas('followings', [
    //         'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
    //     ]);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * ログイン前のユーザーでエラー
    //  * @return void
    //  */
    // public function testFollow_異常系_未ログイン(): void
    // {
    //     $response = $this->post('/follow', [
    //         'followed_review_id' => $this->review->id
    //     ]);

    //     $this->assertDatabaseMissing('followings', [
    //         'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
    //     ]);

    //     $response->assertRedirect('login');
    // }

    // /**
    //  * 存在しないレビューをフォローしようとしてエラー
    //  * @return void
    //  */
    // public function testFollow_異常系_存在しないレビューをフォロー(): void
    // {
    //     Auth::login($this->myself);

    //     $reviewNoExists = $this->review->id + 1;
       
    //     dump($reviewNoExists);
    //     $response = $this->actingAs($this->myself)->post('/follow', [
    //         'followed_review_id' => $reviewNoExists
    //     ]);

    //     $this->assertDatabaseMissing('followings', [
    //         'follower_user_id' => $this->myself->id, 'poster_id' => $this->myself->id, 'followed_review_id' => $reviewNoExists,
    //     ]);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * 自分の投稿をフォローしようとしてエラー
    //  * @return void
    //  */
    // public function testFollow_異常系_自分のレビューをフォロー(): void
    // {
    //     Auth::login($this->user);

    //     $response = $this->actingAs($this->user)->post('/follow', [
    //         'followed_review_id' => $this->review->id
    //     ]);

    //     $this->assertDatabaseMissing('followings', [
    //         'follower_user_id' => $this->user->id, 'poster_id' => $this->myself->id, 'followed_review_id' => $this->review->id,
    //     ]);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * 同じレビューへのフォローでエラー
    //  * @return void
    //  */
    // public function testFollow_異常系_同じレビューをフォロー(): void
    // {
    //     //既に$myselfが$userの投稿をフォローしている状況を設定
    //     $following = Following::create(['follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id]);

    //     Auth::login($this->myself);

    //     $response = $this->actingAs($this->myself)->post('/follow', [
    //         'followed_review_id' => $this->review->id
    //     ]);

    //     $this->assertDatabaseMissing('followings', [
    //         'follower_user_id' => $this->myself->id, 'poster_id' => $this->myself->id, 'followed_review_id' => $this->review->id,
    //     ]);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * フォーロー解除が成功することをテスト
    //  * @return void
    //  */
    // public function testUnFollow_正常系()
    // {
    //     //既に$myselfが$userの投稿をフォローしている状況を設定
    //     $following = Following::create(['follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id]);

    //     Auth::login($this->myself);

    //     $response = $this->actingAs($this->myself)->delete('/follow/delete', [
    //         'followed_review_id' => $this->review->id
    //     ]);

    //     $this->assertDatabaseMissing('followings', [
    //         'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
    //     ]);

    //     $response->assertStatus(200);
    // }

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

            $review = Review::factory([
                'id' => 1,
                'follows' => collect([
                    (object)['user_id' => $this->user->id + 1, 'review_id' => 1],
                    (object)['user_id' => $this->user->id + 2, 'review_id' => 1],
                ]),
            ])->make();

            $mock->shouldReceive('find')->once()->andReturn($review);
        });

        Auth::login($this->user);

        $response = $this->actingAs($this->user)->postJson('/follow', ['reviewId' => 1]);

        $this->assertSessionHas('flash_message', 'レビューをフォローしました！');
        $response->assertJson(['bool' => true, 'count' => 3]);
    }
}
