<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    //updated_atカラムが存在しないことを指定
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'follower_user_id',
        'poster_id',
        'followed_review_id',
    ];


    /**
     * テーブルに関連付ける主キー
     * @var unsignedBigInteger
     */
    protected $primaryKey = ['follower_user_id', 'followed_review_id'];

    /**
     * モデルの主キーを自動増分しない
     * @var bool
     */
    public $incrementing = false;

    /**
     * レビューをフォローしているユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ユーザーがフォローしているレビューを取得
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
