<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Review;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $school;
    private $review;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->school = School::factory()->create();

        $this->review = Review::factory()->for($this->user)->for($this->school)->create();
    }

    /**
     * スクールに紐付くレビューリストが表示されることをテスト
     * 
     * @return
     */
    public function test_users_can_see_reviewList()
    {
        $response = $this->actingAs($this->user)->get('/reviews/school/' . $this->school->id);

        $response->assertViewIs('auth.review.review-list')->assertViewHas('reviews');
    }

    /**
     * レビューページが表示されることをテスト
     * 
     * @return void
     */
    public function test_users_can_visit_review(): void
    {   
        $response = $this->actingAs($this->user)->get('/reviews/review/' . $this->review->id);

        $response->assertViewIs('auth.review.review')->assertViewHas('review', $this->review);
    }

    /**
     * レビュー作成ページへのリダイレクトが成功することをテスト
     *
     * @return void
     */
    public function test_users_can_visit_addReview(): void
    {
        $response = $this->actingAs($this->user)->get('/reviews/add');

        $response->assertStatus(200)->assertViewIs('auth.review.create');
    }

    /**
     * レビュー投稿が成功することをテスト
     * 
     * @return void
     */
    public function test_users_can_create_review()
    {
        $review = Review::factory()->for($this->user)->for($this->school)->make(['course' => 'test'])->toArray();

        //ユーザーとしてpostで送る
        $response = $this->actingAs($this->user)->post('/reviews/create', $review);

        //新規レビューがDBに存在することを確認
        $this->assertDatabaseHas('reviews', ['course' => 'test']);
        
        $review_id = Review::max('id');
        
        //レビューページが表示されることを確認
        $response->assertRedirect('/reviews/review/' . $review_id);
    }

    /**
     * レビューの削除が成功することをテスト
     * @return void
     */
    public function test_users_can_delete_review()
    {
        $response = $this->actingAs($this->user)->delete('/reviews/delete', ['id' => $this->review->id]);

        //dbに存在しないことを確認
        $this->assertDatabaseMissing('reviews', $this->review->toArray());

        $response->assertRedirect(route('user.review'));
    }
}