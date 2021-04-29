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

    /**
     * レビューページが、そのレビューに紐付いたメッセージ履歴と共に表示されることをテスト
     * @return void
     */
    public function testIndex_正常系(): void
    {   
        $user = User::factory()->create();
        $school = School::create(['school_name' => 'hoge', 'school_url' => 'hoge', 'address' => 'hoge', 'features' => 'hoge']);
        $review = Review::factory(['user_id' => $user->id])->create();

        $message = 'こんにちは';
        $message = Message::create(['user_id' => $user->id, 'review_id' => $review->id, 'message' => $message]);

        Auth::login($user);

        $response = $this->actingAs($user)->get('/reviews');

        $response->assertViewIs('auth.review.review')->assertSee($message);
    }

    /**
     * レビュー作成ページへのリダイレクトが成功することをテスト
     *
     * @return void
     */
    // public function testAdd_正常系(): void
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
    // public function testCreate_正常系()
    // {
    //     //認証済みユーザーつくる
    //     Auth::login($user = User::factory()->create());

    //     //サンプルレビューデータ作る
    //     $review = [
    //         'school_id' => rand(0,20),
    //         'course' => 'hogehoge',
    //         'tuition' => 560000,
    //         'purpose' => rand(0,4),
    //         'when_start' => '2018-04-01',
    //         'when_end' => '2018-06-30',
    //         'at_school' => true,
    //         'achievement' => rand(0,4),
    //         'st_tuition' => rand(0,4),
    //         'st_term' => rand(0,4),
    //         'st_curriculum' => rand(0,4),
    //         'st_mentor' => rand(0,4),
    //         'st_support' => rand(0,4),
    //         'st_staff' => rand(0,4),
    //         'total_judg' => rand(0,4),
    //         'title' => str_repeat('a test title', 2),
    //         'report' => str_repeat('a test', 20),
    //     ];

    //     //ユーザーとしてpostで送る
    //     $response = $this->actingAs($user)->post('/reviews/create', $review);

    //     //dbにあるか確認
    //     $this->assertDatabaseHas('reviews', $review);

    //     //リダイレクトを確認
    //     $response->assertStatus(200)->assertViewIs('auth.review.review');
    // }

    /**
     * レビューの削除が成功することをテスト
     * @return void
     */
    // public function testDelete()
    // {
    //     //認証済みのユーザーを作成
    //     Auth::login($user = User::factory()->create());

    //     //schoolsテーブルにデータを作る
    //     School::create([
    //         'name' => 'hogehoge',
    //         'image_path' => 'hogehoge',
    //         'school_url' => 'Hogehoge', 
    //         'address' => 'hogehoge',
    //         'learning_style' => 0,
    //         'features' => 'hogehoge'
    //     ]);

    //     //作成したユーザーに紐付くサンプルレビューデータ作る
    //     $reviewForm = [
    //         'user_id' => $user->id,
    //         'school_id' => 1,
    //         'course' => 'hogehoge',
    //         'tuition' => 560000,
    //         'purpose' => rand(0,4),
    //         'when_start' => '2018-04-01',
    //         'when_end' => '2018-06-30',
    //         'at_school' => true,
    //         'achievement' => rand(0,4),
    //         'st_tuition' => rand(0,4),
    //         'st_term' => rand(0,4),
    //         'st_curriculum' => rand(0,4),
    //         'st_mentor' => rand(0,4),
    //         'st_support' => rand(0,4),
    //         'st_staff' => rand(0,4),
    //         'total_judg' => rand(0,4),
    //         'title' => str_repeat('a test title', 2),
    //         'report' => str_repeat('a test', 20),
    //     ];

    //     $review = Review::create($reviewForm);

    //     $response = $this->actingAs($user)->delete('/reviews/delete', ['id' => $review->id]);

    //     //dbに存在しないことを確認
    //     $this->assertDatabaseMissing('reviews', $reviewForm);

    //     $response->assertStatus(200)->assertViewIs('auth.review.review');
    // }
}