<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Services\RankingService;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    /**
     * The attributes that are mass nonassignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * featuresカラムを取得するときに配列にキャスト
     * 
     * @var array
     */
    protected $casts = [
        'features' => 'array'
    ];

    /**
     * スクールに投稿されたレビューを取得
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * スクールとお気に入りしたユーザーを紐付けるfollowingを取得
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * 現在認証中のユーザーが
     * スクールをいいねしているか判定する
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
