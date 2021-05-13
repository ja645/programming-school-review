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
            'course' => 'required|string',
            'tuition' => 'required|integer',
            'purpose' => 'required|integer|between:0,4',
            'when_start' => 'required|date',
            'when_end' => 'required|date',
            'at_school' => 'required|boolean',
            'st_tuition' => 'required|integer|between:0,4',
            'st_term' => 'required|integer|between:0,4',
            'st_curriculum' => 'required|integer|between:0,4',
            'st_mentor' => 'required|integer|between:0,4',
            'st_support' => 'required|integer|between:0,4',
            'st_staff' => 'required|integer|between:0,4',
            'total_judg' => 'required|integer|between:0,4',
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
