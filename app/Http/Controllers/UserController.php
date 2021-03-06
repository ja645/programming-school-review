<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignupFormRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Following;
use App\Models\Review;
use App\Models\Like;

class UserController extends Controller
{
    /**
     * マイページを表示
     * @return view
     */
    public function index()
    {
        $user = User::find(Auth::id());

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
     * @param \App\Http\Requests\SignupFormRequest $request
     * @return view
     */
    public function create(SignupFormRequest $request)
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
        $user = User::find(Auth::id());
       
       return view('auth.user.edit', ['profile_form' => $user]); 
    }

    /**
    * ユーザー情報を更新
    * @param \App\Http\Requests\UserUpdateRequest $request
    * @return view
    */
    public function update(UserUpdateRequest $request)
    {
        $user = User::find(Auth::id());

        $editedField = $request->all();
        $user->fill($editedField)->save();

        Session::flash('flash_message', '会員情報の変更が完了しました！');

        return redirect(route('mypage'));
    }

    /**
     * ユーザーの退会処理
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        $user_id = Auth::id();

        User::find($user_id)->delete();

        return redirect(route('top'))->with(['flash_message' => '退会手続きが完了しました！']);
    }

    /**
     * 自分の投稿したレビュー一覧を表示
     * 
     * @return view
     */
    public function showMyReview()
    {
        $user_id = Auth::id();

        $reviews = Review::where('user_id', $user_id)->paginate(10);

        return view('auth.user.myreview', ['reviews' => $reviews]);
    }

    /**
     * 自分のフォローしたレビュー一覧を表示
     * 
     * @return view
     */
    public function showFollowingsList()
    {
        $user_id = Auth::id();

        $followings = Following::where('user_id', $user_id)->paginate(10);

        return view('auth.user.followings-list', ['followings' => $followings]);
    }

    /**
     * 自分のいいねしたスクール一覧を表示
     * 
     * @return view
     */
    public function showLikesList()
    {
        $user_id = Auth::id();

        $likes = Like::where('user_id', $user_id)->paginate(10);

        return view('auth.user.likes-list', ['likes' => $likes]);
    }
}
