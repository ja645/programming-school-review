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

    /**
     * レビューの投稿者を取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * レビューと、フォローしているユーザーを紐付けるfollowingを取得
     */
    public function follows()
    {
        return $this->hasMany(Following::class);
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

        // 配列にレビューをlikeしているユーザーのidを格納
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
