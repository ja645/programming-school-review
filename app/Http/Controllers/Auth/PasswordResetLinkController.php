<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.forgot-password');
        return view('auth.sendEmailtoResetPassword');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email:strict,spoof,dns', 'max:256'],
            // 'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // パスワードリセット用リンクをメール送信する
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status == Password::RESET_LINK_SENT
                    // ? back()->with('status', __($status))
                    // 送信に成功したらマイページにリダイレクトし、フラッシュメッセージを表示する
                    ? redirect(route('mypage'))->with('flash_message', 'パスワード再設定用メールを送信しました！')
                    // 送信に失敗したら、パスワードリセットページにリダイレクトし、エラーを表示
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
