<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;
use App\Models\Review;
use App\Models\Following;

class ReviewTest extends TestCase
{
    private $user;
    private $review;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $school = School::factory()->create();

        $this->review = Review::factory()->for($this->user)->for($school)->create();
    }

    /**
     * ユーザーがレビューをフォローしている場合に
     * id_followed_by_auth_user()がtrueを返すことをテスト
     * @test
     */
    public function  id_liked_by_auth_userがtrueを返す()
    {
        Auth::login($this->user);

        // 現在のユーザーがレビューをフォローしている状態を作る
        Following::create(['user_id' => $this->user->id, 'review_id' => $this->review->id]);

        $is_review_followed = $this->review->is_followed_by_auth_user();

        $this->assertTrue($is_review_followed);
    }

    /**
     * ユーザーがレビューをフォローしていない場合に
     * id_followed_by_auth_user()がfalseを返すことをテスト
     * @test
     */
    public function  id_liked_by_auth_userがfalseを返す()
    {
        Auth::login($this->user);

        $is_review_followed = $this->review->is_followed_by_auth_user();

        $this->assertFalse($is_review_followed);
    }
}
