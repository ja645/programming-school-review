<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;
use App\Models\Review;
use App\Services\RankingService;
use Mockery\MockInterface;

class RankingServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * RankingServiceクラスのgetSchoolList()メソッドが機能するかテスト
     *
     * @return void
     */
    public function test_canGetSchoolList()
    {
        // Schoolモデルのall()メソッドをモック
        $mock = $this->partialMock(School::class, function (MockInterface $mock) {
            
            /* RankingServiceクラスのgetSchoolList()メソッド内で実行される
               $this->school->all()の返り値をとしてダミーのコレクションを作成 */
            $schools = (object)[
                (object)[
                    'id' => 1,
                    'school_name' => 'hoge',
                    'reviews' => collect([
                        (object)['st_tuition' => 0],
                        (object)['st_tuition' => 2],
                        (object)['st_tuition' => 3],
                    ]),
                ],
                (object)[
                    'id' => 2,
                    'school_name' => 'fuga',
                    'reviews' => collect([
                        (object)['st_tuition' => 0],
                        (object)['st_tuition' => 1],
                        (object)['st_tuition' => 2],
                        (object)['st_tuition' => 3],
                    ]),
                ],
                (object)[
                    'id' => 3,
                    'school_name' => 'hogehoge',
                    'reviews' => collect([
                        // レビューが存在しない場合を検証
                    ]),
                ],
            ];

            $mock->shouldReceive('all')->once()->andReturn($schools);
        });

        $schoolList = app(RankingService::class)->getSchoolList('st_tuition');

        $expected = [
            ['school_id' => 1, 'school_name' => 'hoge', 'column' => 1.7],
            ['school_id' => 2, 'school_name' => 'fuga', 'column' => 1.5],
            // レビューが存在しないとき0を返すことをテスト
            ['school_id' => 3, 'school_name' => 'hogehoge', 'column' => 0],
        ];

        $this->assertSame($expected, $schoolList);
    }
}
