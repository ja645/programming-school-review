<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewFormRequest extends FormRequest
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
            'school_id' => 'required|integer',
            'course_id' => 'required|integer',
            'purpose' => 'required|integer|between:0,4',
            'result' => 'required|boolean',
            'language' => 'required|string',
            'title' => [
                'required',
                'string',
                //半角、全角スペースを含めずに20字以内か検証
                function ($attrubutes, $value, $fail) {
                    $removeSpace = preg_replace("/( |　)/", "", $value);
                    if (strlen($removeSpace) > 20) {
                        return $fail('タイトルは20文字以内で入力してください。');
                    }
                },
            ],
            'tuition' => 'required|integer|between:0,4',
            'term' => 'required|integer|between:0,4',
            'curriculum' => 'required|integer|between:0,4',
            'mentor' => 'required|integer|between:0,4',
            'support' => 'required|integer|between:0,4',
            'staff' => 'required|integer|between:0,4',
            'judgment' => 'required|integer|between:0,4',
            'report' => [
                'required',
                'string',
                //半角、全角スペースを含めずに100字以上か検証
                function ($attrubutes, $value, $fail) {
                    $removeSpace = preg_replace("/( |　)/", "", $value);
                    if (strlen($removeSpace) < 100) {
                        return $fail('100文字以上で入力してください。');
                    }
                }
            ],
        ];

        return $rules;
    }
}
