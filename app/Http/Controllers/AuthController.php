<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        //return view('auth.login');
        return redirect()
            ->route('home')
            ->with('error','You need to sign-in.');
    }
    public function check()
    {
        $credentials=[
            'username'=>request()->get('username'),
            'password'=>request()->get('password')
        ];
        // in validator we can pass string or array (strings with 'and' logic)
        $validator = \Illuminate\Support\Facades\Validator::make(
            $credentials,
            [
                'username' => 'required|min:2|max:255',
                'password' => ['required', 'min:3', 'max:65535']
            ]
        );
        if ($validator->fails()) {
            return back()
                //->with('error',$validator->errors());
                ->withErrors($validator->errors())
                ->withInput(request()->all());
        }

        $remember = request()->get('remember')==='on';
        if (!Auth::attempt($credentials,$remember))
        {
            return back()
                ->withErrors(['username'=>'Login or password is incorrect'])
                ->withInput(request()->all());
        }
        //Login and password passed. Everything Ok.
        return back();
    }
    public function logout()
    {
        Auth::logout();
        //return redirect()->to(request()->server('HTTP_REFERER'));
        return back();
    }
    public function loginAsUser()
    {
        ////////////////////////////////////////////
        //Auth::loginUsingId(2);
        //return redirect()->route('mainpage');
        ////////////////////////////////////////////
        //$user = \App\User::where('username','brent81')->first();
        //Auth::login($user);
        //return redirect()->route('mainpage');
    }
}
