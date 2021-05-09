<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;
use App\Models\Review;
use App\Services\SchoolService;

use function PHPUnit\Framework\assertSame;

class SchoolSatisfactionsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        
    }

    /**
     * SchoolSatisfactionsServiceクラスのgetSatisfactionsメソッドが
     * 正しい値を返すことをテスト
     *
     * @test
     * @return void
     */
    public function 正しい値を返す()
    {
        $user = User::factory()->create();

        // 任意のスクールを作成
        $school = School::create([
            'school_name' => 'test',
            'school_url' => 'test',
            'address' => 'test',
            'features' => 'test',
        ]);

        // スクールに紐付いたレビューレコードを作成
        Review::factory([
            'user_id' => $user->id,
            'school_id' => $school->id,
            'st_tuition' => 5,
            'st_term' => 4,
            'st_curriculum' => 3,
            'st_mentor' => 2,
            'st_support' => 1,
            'st_staff' => 0,
        ])->create();

        Review::factory([
            'user_id' => $user->id,
            'school_id' => $school->id,
            'st_tuition' => 3,
            'st_term' => 2,
            'st_curriculum' => 1,
            'st_mentor' => 0,
            'st_support' => 5,
            'st_staff' => 4,
        ])->create();

        Review::factory([
            'user_id' => $user->id,
            'school_id' => $school->id,
            'st_tuition' => 0,
            'st_term' => 1,
            'st_curriculum' => 2,
            'st_mentor' => 3,
            'st_support' => 4,
            'st_staff' => 5,
        ])->create();

        $expected = [
            'st_tuition' => 2.7,
            'st_term' => 2.3,
            'st_curriculum' => 2.0,
            'st_mentor' => 1.7,
            'st_support' => 3.3,
            'st_staff' => 3.0,
        ];

        $satisfactions = new SchoolService($school);

        $satisfactions = $satisfactions->getSatisfactions();

        assertSame($expected, $satisfactions);
    }

    // public function 返り値が小数点以下1桁である()
    // {

    // }
}