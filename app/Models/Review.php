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
    public function followed()
    {
        return $this->hasMany(Following::class);
    }

    /**
     * 現在認証中のユーザーが
     * レビューにlikeを付けているか判定する
     */
    public function is_liked_by_auth_user()
    {
        // 現在認証されているユーザーのidを取得
        $id = Auth::id();

        $likers = [];

        // 配列にレビューをlikeしているユーザーのidを格納
        foreach ($this->likes as $like) {
            array_push($likers, $like->user_id);
        }

        // 配列に認証中のユーザーidがあればtrueを返す
        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}
