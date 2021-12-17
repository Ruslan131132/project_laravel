<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index(){
        return view('pages.admin.subjects', [
            'subjects' => Subject::all()
        ]);
    }
}
