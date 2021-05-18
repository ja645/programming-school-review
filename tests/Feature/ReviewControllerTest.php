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
     * レビューページが、そのレビューに紐付いたメッセージ履歴と共に表示されることをテスト
     * 
     * @return void
     */
    public function test_users_can_visit_review(): void
    {   
        $message = 'こんにちは';

        $message = Message::create(['user_id' => $this->user->id, 'review_id' => $this->review->id, 'message' => $message]);

        $response = $this->actingAs($this->user)->get('/reviews/review/' . $this->review->id);

        $response->assertViewIs('auth.review.review')->assertViewHas('review', $this->review)->assertSee($message);
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
        //サンプルレビューデータ作る
        // $review = [
        //     'school_id' => rand(0,20),
        //     'course' => 'hogehoge',
        //     'tuition' => 560000,
        //     'purpose' => rand(0,4),
        //     'when_start' => '2018-04-01',
        //     'when_end' => '2018-06-30',
        //     'at_school' => true,
        //     'achievement' => rand(0,4),
        //     'st_tuition' => rand(0,4),
        //     'st_term' => rand(0,4),
        //     'st_curriculum' => rand(0,4),
        //     'st_mentor' => rand(0,4),
        //     'st_support' => rand(0,4),
        //     'st_staff' => rand(0,4),
        //     'total_judg' => rand(0,4),
        //     'title' => str_repeat('a test title', 2),
        //     'report' => str_repeat('a test', 20),
        // ];

        $review = Review::factory()->for($this->user)->for($this->school)->make()->toArray();

        //ユーザーとしてpostで送る
        $response = $this->actingAs($this->user)->post('/reviews/create', $review);

        //dbにあるか確認
        $this->assertDatabaseHas('reviews', $review);

        //レビューページが表示されることを確認
        $response->assertViewIs('auth.review.review');
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