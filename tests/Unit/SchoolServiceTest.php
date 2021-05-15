<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;
use App\Models\Review;
use App\Services\RankingService;
use App\Services\SchoolService;
use Mockery\MockInterface;

use function PHPUnit\Framework\assertSame;

class SchoolServiceTest extends TestCase
{
    use RefreshDatabase;

    private $schoolService;

    private $school;

    public function setUp(): void
    {
        parent::setUp();
 
        $user = User::factory()->create();

        $this->school = School::factory()->create();

        Review::factory()->for($user)->for($this->school)->create([
            'tuition' => 380000,
            'when_start' => date('Y-m-d'),
            'when_end' => date('Y-m-d', strtotime('90day')),
            'st_tuition' => 1,
            'st_term' => 1,
            'st_curriculum' => 0,
            'st_mentor' => 0,
            'st_support' => 0,
            'st_staff' => 0,
            'total_judg' => 0,
        ]);

        Review::factory()->for($user)->for($this->school)->create([
            'tuition' => 560000,
            'when_start' => date('Y-m-d'),
            'when_end' => date('Y-m-d', strtotime('120day')),
            'st_tuition' => 2,
            'st_term' => 2,
            'st_curriculum' => 0,
            'st_mentor' => 0,
            'st_support' => 0,
            'st_staff' => 0,
            'total_judg' => 0,
        ]);

        Review::factory()->for($user)->for($this->school)->create([
            'tuition' => 420000,
            'when_start' => date('Y-m-d'),
            'when_end' => date('Y-m-d', strtotime('40day')),
            'st_tuition' => 3,
            'st_term' => 1,
            'st_curriculum' => 0,
            'st_mentor' => 0,
            'st_support' => 0,
            'st_staff' => 0,
            'total_judg' => 0,
        ]);

        $this->schoolService = new SchoolService($this->school);
    }

    /**
     * SchoolServiceクラスのgetSatisfactions()メソッドが
     * 正しい値を返すことをテスト
     * @return void
     */
    public function testCanGetSatisfaction()
    {
        $expected = [
            // 割り切れるときも小数第一位までを返すか確認
            'st_tuition' => 2.0,
            // 小数点第二位を四捨五入して返すか確認
            'st_term' => 1.3,
            // 結果が0の時は整数にキャストされるか確認
            'st_curriculum' => 0,
            'st_mentor' => 0,
            'st_support' => 0,
            'st_staff' => 0,
            'total_judg' => 0,
        ];

        $satisfactions = $this->schoolService->getSatisfactions();

        assertSame($expected, $satisfactions);
    }

    /**
     * SchoolServiceクラスのgetTuitionAverage()メソッドが
     * 正しい値を返すことをテスト
     * @return void
     */
    public function testCanGetTuitionAverage()
    {
        $tuitionAverage = $this->schoolService->getTuitionAverage();

        assertSame(453333, $tuitionAverage);
    }

    /**
     * SchoolServiceクラスのgetTermAverage()メソッドが
     * 正しい値を返すことをテスト
     * @return void
     */
    public function testCanGetTermAverage()
    {
        $termAverage = $this->schoolService->getTermAverage();

        assertSame(83, $termAverage);
    }


    /**
     * スクールに投稿されたレビューが存在しないとき、
     * getSatisfactions()
     * getTuitionAverage()
     * getTermAverage()が0を返すことをテスト
     * @test
     * @return void
     */
    public function レビューが存在しないとき0を返す()
    {
        $schoolHasNoReview = School::factory()->create();

        $schoolService = new SchoolService($schoolHasNoReview);

        $satisfactions = $schoolService->getSatisfactions();

        $tuitionAverage = $schoolService->getTuitionAverage();

        $termAverage = $schoolService->getTermAverage();

        $expected = [
            'st_tuition' => 0,
            'st_term' => 0,
            'st_curriculum' => 0,
            'st_mentor' => 0,
            'st_support' => 0,
            'st_staff' => 0,
            'total_judg' => 0,
        ];

        $this->assertSame($expected, $satisfactions);

        $this->assertSame(0, $tuitionAverage);

        $this->assertSame(0, $termAverage);
    }


    /**
     * SchoolServiceクラスのgetRank()メソッドが
     * 正しい値を返すことをテスト
     * @return void
     */
    public function testCanGetRank()
    {
        $mock = $this->mock(RankingService::class, function (MockInterface $mock) {
            // $this->schoolが2位となるダミーのスクールリストを作成
            $schoolList = [
                ['school_id' => $this->school->id, 'school_name' => 'hoge', 'column' => 5],
                ['school_id' => $this->school->id + 1, 'school_name' => 'fuga', 'column' => 4],
                ['school_id' => $this->school->id + 2, 'school_name' => 'hogehoge', 'column' => 6],
            ];
            
            $mock->shouldReceive('getSchoolList')->once()->andReturn($schoolList);
        });

        $rank = $this->schoolService->getRank();
        
        assertSame(2, $rank);
    }
}