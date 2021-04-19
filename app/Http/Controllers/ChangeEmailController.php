<?php

namespace App\Http\Controllers;

use App\Models\EmailReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ChangeEmailController extends Controller
{
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
     * @param \App\Http\Requests\UserFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendChangeEmailLink(Request $request)
    {
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
            $email_reset = EmailReset::create($param);

            DB::commit();

            $email_reset->sendEmailResetNotification($token);

            return redirect('/')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->with('flash_message', 'メール更新に失敗しました。');
        }
    }
}