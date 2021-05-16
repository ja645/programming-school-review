<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'user_name' => 'required|string|max:30',
            'birthday' => 'required|date|before:today',
            'sex'=> 'required|integer|min:0|max:2',
            'former_job' => 'nullable',
            'job' => 'nullable',
        ];

        return $rules;
    }
}
