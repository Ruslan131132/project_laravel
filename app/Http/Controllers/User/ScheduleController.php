<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(){
        $schedule = Auth::user()->user_type == 'Ученик'
            ? Schedule::where('class_id', Auth::user()->pupil->class_id)->orderByRaw('day_number ASC, lesson_number ASC')->get()
            : Auth::user()->teacher->schedule->sortBy(['day_number', 'lesson_number']);
        $days = Day::all();
        $lessons = Lesson::all()->map(function($lesson) {
            return substr($lesson->start_time, 0, -3).'-'.substr($lesson->end_time, 0, -3);
        });
        return view('pages.user.schedule', [
            'schedule' => $schedule,
            'days' => $days,
            'lessons' => $lessons
        ]);
    }
}
