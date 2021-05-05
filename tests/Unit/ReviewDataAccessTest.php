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
    public function getSchoolList_正しく機能するかテスト()
    {
        // テストデータを作る
        $user = User::factory()->create();
        $school = School::create(['school_name' => 'test', 'school_url' => 'test', 'address' => 'test', 'features' => 'test']);
        $school2 = School::create(['school_name' => 'test2', 'school_url' => 'test2', 'address' => 'test2', 'features' => 'test2']);

        Review::factory(['user_id' => $user->id, 'school_id' => $school->id, 'st_tuition' => 5])->create();
        Review::factory(['user_id' => $user->id, 'school_id' => $school->id, 'st_tuition' => 2])->create();
        Review::factory(['user_id' => $user->id, 'school_id' => $school->id, 'st_tuition' => 1])->create();

        Review::factory(['user_id' => $user->id, 'school_id' => $school2->id, 'st_tuition' => 4])->create();
        Review::factory(['user_id' => $user->id, 'school_id' => $school2->id, 'st_tuition' => 3])->create();
        Review::factory(['user_id' => $user->id, 'school_id' => $school2->id, 'st_tuition' => 4])->create();

        $expected = [$school->id => 2.7, $school2->id => 3.7];

        // $this->ReviewはReviewRepositoryTestでインスタンス化されたReviewRepository
        $SchoolList = $this->Review->getSchoolList('st_tuition');

        // getColumnSum()で得られた合計値が正しいか検証
        $this->assertSame($expected, $SchoolList);
    }
}
