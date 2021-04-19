<?php

namespace Tests\Unit;

use Tests\TestCase; //変更
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordRequestTest extends TestCase
{
    /**
     * ChangePasswordRequestのrulesが正しく機能するかテスト
     * withValidatorメソッドについては検証しない
     * @param array
     * @param array
     * @param boolean
     * @dataProvider dataChangePasswordForm
     */
    public function testWorkChangePasswordRequest(array $data, bool $expected) :void
    {            
        $request = new ChangePasswordRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataChangePasswordForm()
    {
        return [
            '正常' => [
                ['current_password' => 'password1', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'],
                true,
            ],
            "'current_password'が数字なしでエラー" => [
                ['current_password' => 'password', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'],
                false,
            ],
            "'current_password'が全角文字使用でエラー" => [
                ['current_password' => 'ｐａｓｓword1', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'],
                false,
            ],
            "'current_password'が8文字未満でエラー" => [
                ['current_password' => 'passwor', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'],
                false,
            ],
            "'current_password'が101文字以上でエラー" => [
                ['current_password' => str_repeat('password1', 11) . 'pa', 'new_password' => 'password2', 'new_password_confirmation' => 'password2'],
                false,
            ],
            "'new_password'と'password_confirmation'が不一致でエラー" => [
                ['current_password' => 'password1', 'new_password' => 'password2', 'new_password_confirmation' => 'password3'],
                false,
            ],
        ];
    }
}
