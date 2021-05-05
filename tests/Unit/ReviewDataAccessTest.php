<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\School;
use App\Models\Review;
use App\Services\ReviewDataAccess;

class ReviewDataAccessTest extends TestCase
{
    /**
     * getColumnSum()メソッドが正しく機能するかをテスト
     * @test
     * @return void
     */
    public function getColumnSum合計を取得出来るかテスト()
    {
        // テストデータを作る
        $user = User::factory()->create();
        $school = School::create(['school_name' => 'test', 'school_url' => 'test', 'address' => 'test', 'features' => 'test']);
        Review::factory(['user_id' => $user->id, 'school_id' => $school->id, 'st_tuition' => 5])->create();
        Review::factory(['user_id' => $user->id, 'school_id' => $school->id, 'st_tuition' => 3])->create();

        // $this->ReviewはReviewRepositoryTestでインスタンス化されたReviewRepository
        $sum = $this->Review->getColumnSum($school->id, 'st_tuition');

        // getColumnSum()で得られた合計値が正しいか検証
        $this->assertSame(8, $sum);
    }
}
