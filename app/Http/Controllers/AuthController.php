<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function check()
    {
        $referer = request()->server('HTTP_REFERER');
        $credentials=[
            'username'=>\request()->get('username'),
            'password'=>\request()->get('password')
        ];
        $remember = \request()->get('remember')==='on';
        if (!Auth::attempt($credentials,$remember))
        {
            return redirect()->to($referer)
                ->withErrors(['username'=>'Login or password is incorrect']);
        }


        return redirect()->to($referer);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->to(request()->server('HTTP_REFERER'));
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
