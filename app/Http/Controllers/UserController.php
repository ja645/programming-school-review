<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    /**
     * マイページを表示
     * @return view
     */
    public function index()
    {
        $user = Auth::user();

        return view('auth.user.mypage', ['profile_form' => $user]);
    }

    /**
     * 新規ユーザー登録ページを表示
     * @return view
     */
    public function add()
    {
        return view('layouts.user.create');
    }

    /**
     * 新規ユーザーを保存
     * @param \App\Http\Requests\UserFormRequest $request
     * @return view
     */
    public function create(UserFormRequest $request)
    {        
        // 保存処理のトランザクションとエラーメッセージが必要では？
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

        event(new Registered($user));

        Session::flash('flash_message', '会員登録が完了しました！');
        
        return redirect(route('mypage'));
    }

    /**
     * ユーザー情報の編集ページを表示
     * @return view
     */
    public function edit()
    {
        //現在認証されているユーザーの情報を取得
        $user = Auth::user();
       
       return view('auth.user.edit', ['profile_form' => $user]); 
    }

    /**
    * ユーザー情報を更新
    * @param \App\Http\Requests\UserFormRequest $request
    * @return view
    */
    public function update(UserFormRequest $request)
    {
        $user = Auth::user();

        $editedField = $request->all();
        $user->fill($editedField)->save();

        Session::flash('flash_message', '会員情報の変更が完了しました！');

        return view('auth.user.mypage', ['profile_form' => $user]);
    }

    /**
     * ユーザーの退会処理
     * @return view
     */
    public function delete()
    {
        $user_id = Auth::id();

        User::find($user_id)->delete();

        Session::flash('flash_message', '退会手続きが完了しました！');

        return view('layouts.top');
    }

    /**
     * 自分の投稿したレビュー一覧を表示
     */
    public function showMyReview()
    {
        $user = Auth::user();

        return view('auth.user.myreview', ['user' => $user]);
    }
}
