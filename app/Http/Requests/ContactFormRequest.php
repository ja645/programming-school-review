<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'have_account' => 'required|boolean',
            'email' => 'required|email:strict,dns,spoof|max:256',
            'title' => [
                'required',
                'string',
                //半角、全角スペースを含めずに30字以内か検証
                function ($attrubutes, $value, $fail) {
                    $removeSpace = preg_replace("/( |　)/", "", $value);
                    if (strlen($removeSpace) > 30) {
                        return $fail('件名は30文字以内で入力してください。');
                    }
                },
            ],
            'inquiry' => [
                'required',
                'string',
                //半角、全角スペースを含めずに1000字以内か検証
                function ($attrubutes, $value, $fail) {
                    $removeSpace = preg_replace("/( |　)/", "", $value);
                    if (strlen($removeSpace) > 1000) {
                        return $fail('お問い合わせ内容は1000文字以内で入力してください。');
                    }
                },
            ],
        ];

        return $rules;
    }
}
