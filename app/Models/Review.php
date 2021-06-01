<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass nonassignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'when_start',
        'when_end',
    ];

    /**
     * レビューの投稿者を取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * レビューの対象のスクールを取得
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
    /**
     * レビューと、フォローしているユーザーを紐付けるfollowingを取得
     */
    public function follows()
    {
        return $this->hasMany(Following::class);
    }

    /**
     * レビューに対して寄せられたメッセージを取得
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * 現在認証中のユーザーが
     * レビューをフォローしているか判定する
     */
    public function is_followed_by_auth_user()
    {
        // 現在認証されているユーザーのidを取得
        $id = Auth::id();

        $followers = [];

        // 配列にレビューをfollowしているユーザーのidを格納
        foreach ($this->follows as $follow) {
            array_push($followers, $follow->user_id);
        }

        // 配列に認証中のユーザーidがあればtrueを返す
        if (in_array($id, $followers)) {
            return true;
        } else {
            return false;
        }
    }
}
