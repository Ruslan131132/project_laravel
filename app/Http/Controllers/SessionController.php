<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function setPage(Request $request){
        Session::put('current_page', $request->input('current_page') );
        if ($request->input('current_subpage')){
            Session::put('current_subpage', $request->input('current_subpage') );
        }
        return redirect()->back();
    }

}
