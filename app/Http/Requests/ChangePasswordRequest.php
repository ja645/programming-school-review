<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Dotenv\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //現在のパスワードと新しいパスワードが正しい形式か検証
        return [
            //パスワードの正規表現は半角英数字をそれぞれ1つ以上使い8字以上100字以下
            'current_password' => 'required|regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i',
            'new_password' => 'required|regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i|confirmed'
        ];
    }
    
    /**
     * 入力された現在のパスワードがDBに登録されたものと等しいか検証
     * @param \Illuminate\Validation\Validator $validator
     * @return void|mixed $validator
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function($validator) {
            //現在認証しているユーザーを取得
            $auth = Auth::user();
            
            //Hash::check()で平文で入力された'current_password'とDBのハッシュ化されたpasswordを比較している
            if (!(Hash::check($this->input('current_password'), $auth->password))) {
                //比較して合わなければエラーメッセージを返す
                $validator->errors()->add('current_password', __('現在のパスワードが間違っています。'));
            }
        });
    }
}