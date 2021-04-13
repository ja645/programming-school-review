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
    public function add()
    {
        return view('user.create');
    }

    /**
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
    * @param \App\Http\Requests\UserFormRequest $request
    * @return \Illuminate\Http\Response 
    */
    public function update(UserFormRequest $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $session = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($session);

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
