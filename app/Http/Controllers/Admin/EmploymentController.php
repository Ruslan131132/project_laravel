<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmploymentController extends Controller
{
    public function index(){
        $teachers = User::where('user_type', 'Учитель')->orderBy('surname', 'asc')->get();
        if (!Session::has('current_page') || Session::get('current_page') != 'employment'){
            Session::put('current_page', 'employment');
            Session::put('current_subpage', $teachers->first()->user_id);
        }
        $schedule = $teachers->where('user_id', Session::get('current_subpage'))->first()->teacher->schedule->sortBy([
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
        return back()->with('success', 'Занятость успешно добавлена!');
    }

    public function delete(Request $request){
        return back()->with('success', 'Занятость удалена!');
    }
}
