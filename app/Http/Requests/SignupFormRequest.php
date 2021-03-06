<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SignupFormRequest extends FormRequest
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
     * @return array
     */
    public function rules() :array
    {

        $rules = [
            'user_name' => 'required|string|max:30',
            'birthday' => 'required|date|before:today',
            'sex'=> 'required|integer|min:0|max:2',
            'former_job' => 'nullable',
            'job' => 'nullable',
            'email' => ['required', 'string', 'email:strict,spoof,dns', 'max:256', 'unique:users,email'],
            'password' => ['required', 'regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', 'confirmed'],
        ];
        
        // switch ($route) {
        //     case 'signup' :
        //         $rules['email'] = 'required|email:strict,dns,spoof|max:256|unique:users,email';
        //         //パスワードの正規表現は半角英数字をそれぞれ1つ以上使い8字以上100字以下
        //         $rules['password'] = 'required|regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i|confirmed';
        //         break;
            
        //     case 'email' :
        //         $rules = [
        //             'new_email' => 'required|email:strict,dns,spoof|max:256|unique:users,email'
        //         ];
        //         break;
        // }

        return $rules;
    }
    
    /**
     * バリデーションに対応したエラーメッセージを定義
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i' => 'パスワードは半角英数字をそれぞれ1文字以上使用し、8文字以上100文字以内で入力してください。'
        ];
    }
}
