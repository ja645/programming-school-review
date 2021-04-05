<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserFormRequest extends FormRequest
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
    public function rules() :array
    {
        return [
            'user_name' => 'required|string|max:30',
            'birthday' => 'required|date|before:today',
            'sex'=> 'required|integer|min:0|max:2',
            'former_job' => 'nullable',
            'job' => 'nullable',
            'school_id' => 'required|integer',
            'email' => 'required|email:strict,dns,spoof|max:256|unique:users',
            //パスワードの正規表現は半角英数字をそれぞれ1つ以上使い8字以上100字以下
            'password' => 'required|regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i|confirmed',
        ];
    }
}
