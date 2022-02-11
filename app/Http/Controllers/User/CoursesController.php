<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CoursesController extends Controller
{
    public function index() {
        $courses = Course::all();
        return view('pages.user.courses', ['courses' => $courses]);
    }
}
