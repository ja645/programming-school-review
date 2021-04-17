<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule; //追記
use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
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
        dump($this->input('follower_user_id'));
        return [
            // 'follower_user_id' => [
            //     'required',
            //     'integer',
            // ],

            'poster_id' => [
                'required',
                'integer',
                function ($attrubutes, $value, $fail) {
                    if ($value === $this->input('follower_user_id')) {
                        return $fail('自分のレビューは評価出来ません。');
                    }
                },
            ],

            'followed_review_id' => [
                'required',
                'integer',
                /*'follow_user_id'との複合キーにunique制約を持たせる
                  'follower_user_id'が一致するレコードにuniqueを適用する*/
                Rule::unique('followings')->where(function($query) {
                    $query->where('follower_user_id', $this->input('follower_user_id'));
                }),
            ],
        ];
    }
}
