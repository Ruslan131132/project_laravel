<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index(){
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->get();
        $count = 0;
        foreach ($users as $user)
            if(Cache::has('user-is-online-' . $user->user_id))
                $count++;

        return view('pages.admin.main', [
            'all_users' => count($users),
            'users_online' => $count
        ]);
    }
}
