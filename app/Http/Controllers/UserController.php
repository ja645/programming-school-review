<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add()
    {
        return view('auth.user.create');
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
        
        // dump($request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));
        return redirect('top');
    }

    public function edit()
    {

    }

    /**
    * @param \App\Http\Requests\UserFormRequest $request
    * @return \Illuminate\Http\Response 
    */
    public function update(UserFormRequest $request)
    {
        $currentUserId = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        if (Auth::id() === $currentUserId) {
            $user = User::find($currentUserId);
            $editedUser = $request->all();
            $user->fill($editedUser)->save();
        }
        
        dump($request->session()->all());
        return redirect('users');
    }
}
