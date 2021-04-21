<?php

namespace Tests\Unit;

use Tests\TestCase; //変更
use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserFormRequestTest extends TestCase
{
    /**
     * UserFormRequestのバリデーションが正しく機能するかテスト
     * @param array
     * @param array
     * @param boolean
     * @dataProvider dataUserForm
     */
    public function testWorkUserFormRequest(array $keys, array $values, bool $expected) :void
    {   
        $rules = [
            'user_name' => 'required|string|max:30',
            'birthday' => 'required|date|before:today',
            'sex'=> 'required|integer|min:0|max:2',
            'former_job' => 'nullable',
            'job' => 'nullable',
            'email' => 'required|email:strict,dns,spoof|max:256|unique:users,email',
            'password' => 'required|regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i|confirmed',
        ];

        $dataList = array_combine($keys, $values);

        // $request = new UserFormRequest();

        // $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataUserForm()
    {
        return [
            '正常_nullableがnull' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                true
            ],
            '正常' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 1, '公務員', 'エンジニア', 'test@gmail.com', 'password1', 'password1'],
                true
            ],
            'user_nameが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                [null, '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'user_nameが形式外でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                [1234, '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'user_nameが文字数オーバーでエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                [str_repeat('a', 31), '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'user_nameが文字数制限内でOK' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                [str_repeat('a', 30), '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                true
            ],
            'birthdayが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', null, 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'birthdayが形式外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', 'abcdefg', 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'birthdayが未来でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', "20230101", 1, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'sexが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', null, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'sexが形式外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 'abcdef', null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'sexが0~2以外でエラー' => [
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', "2013-5-30 00:00:00.000000", 3, null, null, 'test@gmail.com', 'password1', 'password1'],
                false
            ],
            'emailが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, null, 'password1', 'password1'],
                false
            ],
            'emailが形式外でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.comあいうえお', 'password1', 'password1'],
                false
            ],
            'emailが文字数オーバーでエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, str_repeat('a', 245) . '@gmail.com', 'password1', 'password1'],
                false
            ],
            'passwordが空でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', null, null],
                false
            ],
            'passwordが文字数未満でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'passwo1', 'passwo1'],
                false
            ],
            'passwordが文字数オーバーでエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', str_repeat('password1', 12), str_repeat('password1', 13)],
                false
            ],
            'passwordが形式外でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', '!password1', '!password1'],
                false
            ],
            'confirmationが不一致でエラー' =>[
                ['user_name', 'birthday', 'sex', 'former_job', 'job', 'email', 'password', 'password_confirmation'],                        
                ['田中 太郎', '2013-5-30 00:00:00.000000', 1, null, null, 'test@gmail.com', 'password', 'password1'],
                false
            ],
        ];
    }
}
