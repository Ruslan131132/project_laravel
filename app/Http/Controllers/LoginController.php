<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pupil;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('user_id', 'password');
        if (Auth::attempt($credentials, $request->get('remember_token'))) {
            if (auth()->user()->isAdmin()){
                return redirect(route('admin.main'));
            }
            return redirect(route('user.main'));
        }
        return redirect(route('index'));
    }
}
