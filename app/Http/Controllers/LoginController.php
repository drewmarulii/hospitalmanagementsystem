<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        if(Auth::user()) {
            // if($user->level == "R001") {
            //     return redirect()->intended('adm-dash');
            // } elseif($user->level == "R002") {
            //     return redirect()->intended('rcp-dash');
            // }
            return redirect()->intended('home');
        }

        return view('login.view_login');
    }

    public function process(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $validation = $request->only('username', 'password');

        if(Auth::attempt($validation)) {
            $request->session()->regenerate();

            if(Auth::user()) {
                return redirect()->intended('home');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The credential does not match to our system'
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
