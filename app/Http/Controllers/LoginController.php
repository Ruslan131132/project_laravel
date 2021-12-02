<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('user_id', 'password');
        if (Auth::attempt($credentials, $request->get('remember_token'))) {
            $user = auth()->user();
            return $user;
//            return redirect()->intended('index');
        }
    }
}
