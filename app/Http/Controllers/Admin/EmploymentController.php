<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Course;
use App\Models\Employment;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function index(){
         return view('pages.admin.employment', [
             'teachers' => Teacher::all(),
             'classes' => ClassInfo::all(),
             'subjects' => Subject::all(),
             'employments' => Employment::paginate(15)
         ]);
    }

    public function create(Request $request){

        $employment = Employment::where('teacher_id', $request->teacher_id)
            ->where('subject_id', $request->subject_id)
            ->where('class_id', $request->class_id)
            ->first();
        if ($employment){
            return back()->with('error', 'Такая занятость уже существует!');
        }
        Employment::create([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
        ]);
        return back()->with('success', 'Занятость успешно добавлена!');
    }

    public function delete(Request $request){
        Employment::where('id', $request->input('employment_id'))->first()->forceDelete();
        return back()->with('success', 'Занятость удалена!');
    }
}
