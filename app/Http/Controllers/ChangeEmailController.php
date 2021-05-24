<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ChangeEmailController extends Controller
{
    public function __construct(EmailReset $emailReset)
    {
        $this->emailReset = $emailReset;
    }

    /**
     * メール変更フォームを返す
     * @return view
     */
    public function showChangeEmailForm()
    {
        return view('auth.email.edit');
    }

    /**
     * メールアドレス確認リンクをメール送信する
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendChangeEmailLink(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email:strict,dns,spoof|max:256|unique:users,email',
        ]);

        $new_email = $request->new_email;

        //トークンを生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );
        
        //トークンをデータベースに保存
        DB::beginTransaction();
        try {
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            // $email_reset = EmailReset::create($param);
            $email_reset = $this->emailReset::create($param);
      
            DB::commit();
      
            $email_reset->sendEmailResetNotification($token);
      
            return redirect('/users')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            dump($e);
            return redirect('/users')->with('flash_message', 'メール更新に失敗しました。');
        }
    }

    /**
     * 新しいメールアドレスでDBを更新
     * @param Request $request
     * @param [type] $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request, $token)
    {
        $email_resets = DB::table('email_resets')
            ->where('token', $token)
            ->first();

        //トークンが存在し、かつ有効期限が切れていないかチェック
        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

            //ユーザーのメールアドレスを更新
            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            //email_resetsのレコードを削除
            DB::table('email_resets')
                ->where('token', $token)
                ->delete();

            return redirect('/users')->with('flash_message', 'メールアドレスを更新しました！');
        } else {

            //レコードが存在していた場合削除
            if ($email_resets) {
                DB::table('email_resets')
                    ->where('token', $token)
                    ->delete();
            }

            return redirect('/users')->with('flash_message', 'メールアドレスの更新に失敗しました。');
        }
    }

    /**
     * トークンに有効期限を設定し、期限切れかチェック
     * @param string $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        //トークンの有効期限は60分に設定
        $expires = 60 * 60;

        //addSeconds()で$createdAtに1時間追加し、isPast()で過去のものかチェック
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }
}