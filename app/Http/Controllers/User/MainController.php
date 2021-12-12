<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('pages.user.main', ['user' => $user]);
    }
}
