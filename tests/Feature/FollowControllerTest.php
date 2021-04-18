<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use App\Models\Following;
use App\Models\School;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowControllerTest extends TestCase
{
    use RefreshDatabase;

    private $myself;
    private $school;
    private $user;
    private $review;

    /**
     * テスト前に既存のユーザー、レビュー、およびfollowing関係を設定
     */
    public function setUp(): void
    {
        parent::setUp();

        //サンプルユーザーを用意
        $this->myself = User::factory()->create();

        //既存のスクールとして用意
        $this->school = School::create([
            'name' => 'hogehoge',
            'image_path' => 'hogehoge',
            'school_url' => 'hogehoge',
            'address' => 'hogehoge',
            'learning_style' => 1,
            'features' => 'hogehoge',
        ]);

        //他のユーザーを用意
        $this->user = User::factory()->create();
    
        //$userが投稿したレビューとして用意
        $this->review = Review::factory(['user_id' => $this->user->id, 'school_id' => $this->school->id])->create();
    }

    /**
     * 認証済みのユーザーが他のユーザーのレビューをフォローできることをテスト
     * @return void
     */
    public function testFollow_正常系(): void
    {
        Auth::login($this->myself);

        $response = $this->actingAs($this->myself)->post('/follow', [
            'followed_review_id' => $this->review->id
        ]);

        $this->assertDatabaseHas('followings', [
            'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
        ]);

        $response->assertStatus(200);
    }

    /**
     * ログイン前のユーザーでエラー
     * @return void
     */
    public function testFollow_異常系_未ログイン(): void
    {
        $response = $this->post('/follow', [
            'followed_review_id' => $this->review->id
        ]);

        $this->assertDatabaseMissing('followings', [
            'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
        ]);

        $response->assertRedirect('login');
    }

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

    /**
     * フォーロー解除が成功することをテスト
     * @return void
     */
    public function testUnFollow_正常系()
    {
        //既に$myselfが$userの投稿をフォローしている状況を設定
        $following = Following::create(['follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id]);

        Auth::login($this->myself);

        $response = $this->actingAs($this->myself)->delete('/follow/delete', [
            'followed_review_id' => $this->review->id
        ]);

        $this->assertDatabaseMissing('followings', [
            'follower_user_id' => $this->myself->id, 'poster_id' => $this->user->id, 'followed_review_id' => $this->review->id,
        ]);

        $response->assertStatus(200);
    }
}
