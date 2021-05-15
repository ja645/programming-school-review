<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
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
        'user_id',
        'school_id',
    ];

    /**
     * テーブルに関連付ける主キー
     * @var unsignedBigInteger
     */
    protected $primaryKey = ['user_id', 'school_id'];

    /**
     * モデルの主キーを自動増分しない
     * @var bool
     */
    public $incrementing = false;

    /**
     * スクールをお気に入りしているユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ユーザーがお気に入りしているスクールを取得
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
