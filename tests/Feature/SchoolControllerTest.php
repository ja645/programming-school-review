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
        // スクールの中から1つピックアップ
        $school = School::first();

        $mock = $this->mock(SchoolService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getSatisfactions')->once()->andReturn(4.3);
            $mock->shouldReceive('getTuitionAverage')->once()->andReturn(3.2);
            $mock->shouldReceive('getTermAverage')->once()->andReturn(2.1);
            $mock->shouldReceive('getRank')->once()->andReturn(1.0);
        });

        $response = $this->actingAs($this->user)->get('/schools/' . $school->id);

        $expected = [
            'school' => $school,
            'satisfactions' => 4.3,
            'tuition_average' => 3.2,
            'term_average' => 2.1,
            'school_rank' => 1.0,
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

        $response->assertViewIs('auth.school.school-list')->assertViewHas('schools');
    }
}
