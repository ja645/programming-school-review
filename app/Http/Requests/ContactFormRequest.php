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
            'have_acount' => 'required|boolean',
            'email' => 'required|email:strict,dns,spoof|max:256',
            'title' => 'required|max:30',
            'inquiry' => 'required|max:1000',
        ];

        return [
            
        ];
    }
}
