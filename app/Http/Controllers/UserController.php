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
        $user = User::find($request->id);
        $editedUser = $request->all();
        $user->fill($editedUser)->save();
        
        return redirect('users');
    }
}
