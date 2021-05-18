<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * パスワード編集ページを返す
     * @return view
     */
    public function showChangePasswordView()
    {
        return view('auth.user.editPassword');
    }

    /**
     * 新しいパスワードに更新
     * @param \App\Http\Requests\ChangePasswordRequest $request
     * @return view
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect(route('mypage'));
    }
}
