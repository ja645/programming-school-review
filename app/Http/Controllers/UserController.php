<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * マイページを表示
     * @return view
     */
    public function index()
    {
        $user = Auth::user();

        return view('auth.user.mypage', ['user' => $user]);
    }

    /**
     * 新規ユーザー登録ページを表示
     * @return view
     */
    public function add()
    {
        return view('user.create');
    }

    /**
     * 新規ユーザーを保存
     * @param \App\Http\Requests\UserFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(UserFormRequest $request)
    {        
        Auth::login($user = User::create([
            'user_name' => $request->user_name,
            'birthday' => $request->birthday,
            'sex' => $request->sex,
            'former_job' => $request->former_job,
            'job' => $request->job,
            'school_id' => $request->school_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));
        
        return redirect('top');
    }

    /**
     * ユーザー情報の編集ページを表示
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $session = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($session);

        $profile = User::find($sessionId);

        if (Auth::id() !== $sessionId) {
            return redirect(403);
        } else {
            return view('auth.user.edit', ['profile_form' => $profile]);
        }
        
    }

    /**
    * ユーザー情報を更新
    * @param \App\Http\Requests\UserFormRequest $request
    * @return \Illuminate\Http\RedirectResponse 
    */
    public function update(UserFormRequest $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //リクエストの中身に受け付けないフィールドが含まれるか調べる
        $correctFields = ['user_name', 'birthday', 'sex', 'former_job', 'job', 'school_id'];
        $requestFields = $request->all();
        $exceptFields = Arr::except($requestFields, $correctFields);

        if (Auth::id() !== $sessionId) {
            return redirect(403);
        } elseif (empty($exceptFields) === false) {
            return redirect(403);
        } else {
            $user = User::find($sessionId);
            $editedUser = $request->all();
            $user->fill($editedUser)->save();

            return redirect('users');
        }
    }
}
