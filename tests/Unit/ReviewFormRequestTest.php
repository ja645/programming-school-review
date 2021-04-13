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

    public function dataReviewForm()
    {
        return [
            '正常' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 1, 'result' => true, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　test', 20), //全角スペース
                ],
                true
            ],

            'user_idがnullでエラー' => [
                [
                    'user_id' => null, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 1, 'result' => true, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　test', 20),
                ],
                false
            ],

            'purposeが範囲外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 5, 'result' => true, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　test', 20),
                ],
                false
            ],

            'resultが論理値以外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 1, 'result' => 2, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　test', 20),
                ],
                false
            ],

            'titleが文字数制限外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 1, 'result' => true, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title a',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　test', 20),
                ],
                false
            ],

            'reportが文字数制限外でエラー' => [
                [
                    'user_id' => 1, 'school_id' => 1, 'course_id' => 1,
                    'purpose' => 1, 'result' => true, 'language' => 'PHP Laravel',
                    'title' => 'a test title a test title',
                    'tuition' => 1, 'term' => 1, 'curriculum' => 1, 'mentor' => 1, 'support' => 1, 'staff' => 1, 'judgment' => 1,
                    'report' => str_repeat('a　te', 33),
                ],
                false
            ],
        ];
    }
}
