<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * レビュー作成ページへのリダイレクトが成功することをテスト
     *
     * @return void
     */
    // public function testAdd_正常系()
    // {
    //     $user = User::factory()->make();

    //     $response = $this->actingAs($user)->get('/reviews/add');

    //     $response->assertStatus(200)->assertViewIs('auth.review.create');
    // }

    /**
     * レビュー投稿が成功することをテスト
     * 
     * @return void
     */
    public function testCreate_正常系()
    {
        //認証済みユーザーつくる
        Auth::login($user = User::factory()->create());

        //サンプルレビューデータ作る
        $review = [
            'school_id' => rand(0,20),
            'course_id' => rand(0,4),
            'purpose' => rand(0,4),
            'result' => true,
            'language' => 'PHP Laravel',
            'title' => str_repeat('a test title', 2),
            'tuition' => rand(0,4),
            'term' => rand(0,4),
            'curriculum' => rand(0,4),
            'mentor' => rand(0,4),
            'support' => rand(0,4),
            'staff' => rand(0,4),
            'judgment' => rand(0,4),
            'report' => str_repeat('a test', 20),
        ];

        //ユーザーとしてpostで送る
        $response = $this->actingAs($user)->post('/reviews/create', $review);

        //dbにあるか確認
        $this->assertDatabaseHas('reviews', $review);

        //リダイレクトを確認
        $response->assertStatus(200)->assertViewIs('auth.review.done');
    }
}
