<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\School;
use App\Models\User;
use App\Models\Review;
use App\Services\SchoolService;
use Mockery;
use Mockery\MockInterface;

class SchoolControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        School::factory()->count(10)->create();

        $this->user = User::factory()->create();
    }


    /**
     * showSchoolList()が正しいデータを持ったビューを返すことをテスト
     * @return void
     */
    public function test_canShowSchoolList(): void
    {
        $schools = School::orderByDesc('created_at');

        $response = $this->actingAs($this->user)->get(route('school.list'));

        $response->assertViewIs('auth.school.school-list')->assertViewHasAll(['schools']);
    }

    /**
     * showSchool()が正しいデータを持ったにスクールページを返すことをテスト
     * @return void
     */
    public function test_canShowSchool(): void
    {
        $mock = $this->mock(SchoolService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getSatisfactions')->once()->andReturn([
                'st_tuition' => 1,
                'st_term' => 1,
                'st_curriculum' => 1,
                'st_mentor' => 1,
                'st_support' => 1,
                'st_staff' => 1,
                'total_judg' => 1,
            ]);
            $mock->shouldReceive('getTuitionAverage')->once()->andReturn(2);
            $mock->shouldReceive('getTermAverage')->once()->andReturn(3);
            $mock->shouldReceive('getRank')->once()->andReturn(4);
        });
            
        // スクールの中から1つピックアップ
        $school = School::first();
        
            
        $response = $this->actingAs($this->user)->get('/schools/' . $school->id);

        $expected = [
            'school' => $school,
            'satisfactions' => [
                'st_tuition' => 1,
                'st_term' => 1,
                'st_curriculum' => 1,
                'st_mentor' => 1,
                'st_support' => 1,
                'st_staff' => 1,
                'total_judg' => 1,
            ],
            'tuition_average' => 2,
            'term_average' => 3,
            'school_rank' => 4,
        ];

        $response->assertViewIs('auth.school.school')->assertViewHas($expected);
    }

    /**
     * スクールの検索機能が正常に動作することをテスト
     * @return void
     */
    public function test_canSearchSchool(): void
    {
        $school = School::factory(['school_name' => 'test searching school' ])->create();

        $response = $this->actingAs($this->user)->post(route('search'), ['school_name' => 'searching']);

        $response->assertViewIs('auth.school.school-list')->assertSee('test searching school');
    }
}
