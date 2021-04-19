<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailReset extends Model
{
    use HasFactory;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'new_email',
        'token',
    ];

    /**
     * メールアドレス確認メールを送信
     * @param [type] $token
     */
    public function sendEmailResetNotification($token)
    {
        $this->notify(new ChangeEmail($token));
    }

    /**
     * new_emailをメールの送信先に指定する
     * @param \Illuminate\Notifications\Notification $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}
