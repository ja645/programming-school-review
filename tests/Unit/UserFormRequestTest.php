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
            '必須エラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id', 'email', 'password'],                        
                ['abc', 20090530, 1, null, null, 1, 'abcd@example.com', 'abc3def'],
                true
            ],
        ];
    }
}
