<?php

namespace Tests\Unit;

use Tests\TestCase; //変更
use App\Http\Requests\ReviewFormRequest;
use Illuminate\Support\Facades\Validator;

class ReviewFormRequestTest extends TestCase
{
    /**
     * ReviewFormRequestが正しく機能するかテスト
     * @param array $dataList
     * @param bool $expected
     * @return void
     * @dataProvider dataReviewForm
     */
    public function testWorkReviewFormRequest(array $dataList, bool $expected)
    {        
        $request = new ReviewFormRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataReviewForm()
    {
        return [
            '正常' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                true,
            ],

            'user_idがnullでエラー' => [
                [
                    'user_id' => null, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                false,
            ],

            'purposeが範囲外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 5, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                false,
            ],

            'when_startがdate型以外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => 2018-04-01, 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                false,
            ],

            'at_schoolが論理値以外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => 2, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                false,
            ],

            'titleが20文字以上でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title a',
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                false,
            ],

            'reportが100文字以下でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course' => 'test Ex course', 'tuition' => 560,000,
                    'purpose' => 1, 'when_start' => '2018-04-01', 'when_end' => '2018-06-30', 'at_school' => true, 'achievement' => 1,
                    'st_tuition' => 1, 'st_term' => 1, 'st_curriculum' => 1, 'st_mentor' => 1, 'st_support' => 1, 'st_staff' => 1, 'total_judg' => 1,
                    'title' => 'a test title a test title',
                    'report' => str_repeat('a　te', 33), //全角スペース
                ],
                false,
            ],
        ];
    }
}
