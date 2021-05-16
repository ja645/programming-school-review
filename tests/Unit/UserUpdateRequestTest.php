<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserUpdateRequest;

class UserUpdateRequestTest extends TestCase
{
    /**
     * UserUpdateRequestのバリデーションが正しく機能するかテスト
     * @param array
     * @param array
     * @param boolean
     * @dataProvider dataUserUpdateForm
     */
    public function test_workUserUpdateRequest(array $keys, array $values, bool $expected): void
    {
        $dataList = array_combine($keys, $values);
        
        $request = new UserupdateRequest();
        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataUserUpdateForm()
    {
        return [
            '正常_nullableがnull' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, null, null],
                true
            ],
            '正常' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, '公務員', 'エンジニア'],
                true
            ],
            'user_nameが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                [null, '2013-5-30 00:00:00.000000', 1, null, null],
                false
            ],
            'user_nameが形式外でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                [1234, '2013-5-30 00:00:00.000000', 1, null, null],
                false
            ],
            'user_nameが文字数オーバーでエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                [str_repeat('a', 31), '2013-5-30 00:00:00.000000', 1, null, null],
                false
            ],
            'user_nameが文字数制限内でOK' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                [str_repeat('a', 30), '2013-5-30 00:00:00.000000', 1, null, null],
                true
            ],
            'birthdayが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', null, 1, null, null],
                false
            ],
            'birthdayが形式外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', 'abcdefg', 1, null, null],
                false
            ],
            'birthdayが未来でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', "20230101", 1, null, null],
                false
            ],
            'sexが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', null, null, null],
                false
            ],
            'sexが形式外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 'abcdef', null, null],
                false
            ],
            'sexが0~2以外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 3, null, null],
                false
            ],
        ];
    }
}
