<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store (Request $request) {
//        dd($request->file('image')->getFilename());
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $name = $request->file('image')->getFilename();
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2048'
                ]);
                $extension = $request->image->extension();
                $files = Storage::files('/public/img/'.Auth::user()->user_id.'/');
                Storage::delete($files);
                $request->image->storeAs('/public/img/'.Auth::user()->user_id.'/', $name.".".$extension);
                $url = Storage::url('img/'.Auth::user()->user_id.'/'.$name.".".$extension);
                User::where('user_id', Auth::user()->user_id)->update(['img' => $url]);
                return \Redirect::back();
            }
        }
        abort(500, 'Could not upload image :(');
    }
}
