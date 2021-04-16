<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Review;
use App\Models\User;
use App\Models\Following;
use App\Http\Requests\FollowRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase; //変更
// use Illuminate\Foundation\Testing\TestCase;


class FollowRequestTest extends TestCase
{
    use RefreshDatabase;

    private $school;
    private $user;
    private $review;

    public function setUp(): void
    {
        parent::setUp();

        //既存のスクールとして用意
        $this->school = School::create([
            'name' => 'hogehoge',
            'image_path' => 'hogehoge',
            'school_url' => 'hogehoge',
            'address' => 'hogehoge',
            'learning_style' => 1,
            'features' => 'hogehoge',
        ]);

        //既存のユーザーとして用意
        $this->user = User::factory()->create();
    
        //既存のレビューとして用意
        $this->review = Review::factory(['user_id' => $this->user->id, 'school_id' => $this->school->id])->create();
    
        //用意したユーザーとレビューの既存のリレーションとして用意
        $following = Following::create(['follower_user_id' => $this->user->id, 'followed_review_id' => $this->review->id]);

    }

    /**
     * FollowRequestが正しく機能するかテスト
     * @param array $dataList
     * @param bool $expected
     * @return void
     * @dataProvider dataFollowRequest
     */
    public function testWorkFollowRequest(array $dataList, bool $expected)
    {
        // dump($this->user->id);
        // dump($this->review->id);
        dump(Following::all());
        // dump($dataList);
        $request = new FollowRequest();
        $rules = $request->rules();
        $validator = Validator($dataList, $rules);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);

        // $response = $this->post('/follow', ['follower_user_id' => 1, 'followed_review_id' => 1,]);
        // $response->assertStatus(200);
    }

    /**
     * testWorkFollowRequestにテストパターンを渡す
     * @return array
     */
    public function dataFollowRequest()
    {
        return [
            '複合主キーが重複してエラー' => [
                ['follower_user_id' => 1, 'followed_review_id' => 1,],
                false,
            ],
        ];
    }
}
