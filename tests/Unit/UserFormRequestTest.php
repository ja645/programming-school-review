<?php

namespace Tests\Unit;

use Tests\TestCase; //変更
use App\Http\Requests\UserFormRequest;
//use Illuminate\Database\Console\DumpCommand;
use Illuminate\Support\Facades\Validator;

class UserFormRequestTest extends TestCase
{
    /**
     * @test
     * @param array
     * @param array
     * @param boolean
     * @dataProvider dataUserRegistration
     */
    public function 必須項目が空ならばエラーとなることをテスト(array $keys, array $values, bool $expected) :void
    {
        $dataList = array_combine($keys, $values);
        
        $request = new UserFormRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        dump($rules);
        dump($dataList);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);
    }

    public function dataUserRegistration()
    {
        return [
            'OK' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, null, null, 1, 'abcd@example.com', 'password'],
                true
            ],
            'OK2' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, '公務員', 'エンジニア', 1, 'abcd@example.com', 'password'],
                true
            ],
            'user_nameが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                [null, '2013-5-30 00:00:00.000000', 1, null, null, 1, 'abcd@example.com', 'password'],
                false
            ],
            'birthdayが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', null, 1, null, null, 1, 'abcd@example.com', 'password'],
                false
            ],
            'sexが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', null, null, null, 1, 'abcd@example.com', 'password'],
                false
            ],
            'school_idが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, null, 'abcd@example.com', 'password'],
                false
            ],
            'emailが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 1, null, 'password'],
                false
            ],
            'passwordが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 1, 'abcd@example.com', null],
                false
            ],
        ];
    }
}
