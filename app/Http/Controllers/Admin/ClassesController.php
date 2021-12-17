<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(){
        $teachers = Teacher::orderBy('surname', 'asc')->get();
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        $courses = Course::all();
        return view('pages.admin.classes', [
            'teachers' => $teachers,
            'classes' => $classes,
            'courses' => $courses,
        ]);
    }

}
