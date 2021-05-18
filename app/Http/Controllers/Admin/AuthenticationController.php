<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * 管理者用ログイン画面を表示する
     * @return view
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * 管理者としてログインする
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $user_id = $request->user_id;

        $passowrd = $request->password;

        if($user_id == 'hoge' && $passowrd == 'fuga') {
            $request->session()->put('admin_auth', true);

            return redirect(route('school-list'));
        } else {
            return redirect(route('admin.login'))->withSession([
                'flash_message' => 'ユーザーIDまたはパスワードが違います。'
            ]);
        }
    }


    /**
     * 管理者としてログアウトする
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->forget('admin_auth');
        return redirect('top');
    }
}
