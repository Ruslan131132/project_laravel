<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Course;
use App\Models\Day;
use App\Models\Employment;
use App\Models\Lesson;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmploymentController extends Controller
{
    public function index(){
        $teachers = Teacher::orderBy('surname', 'asc')->get();
        if (!Session::has('current_page') || Session::get('current_page') != 'employment'){
            Session::put('current_page', 'employment');
            Session::put('current_subpage', $teachers->first()->id);
        }
        $schedule = $teachers->find(Session::get('current_subpage'))->schedule->sortBy([
            'day_number', 'lesson_number'
        ]);
        $days = Day::all();
        $lessons = Lesson::all()->map(function($lesson) {
            return substr($lesson->start_time, 0, -3).'-'.substr($lesson->end_time, 0, -3);
        });

         return view('pages.admin.employment', [
             'teachers' => $teachers,
             'schedule' => $schedule,
             'days' => $days,
             'lessons' => $lessons
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
