<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Day;
use App\Models\Shedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        $class_id = 1;
        $classes = ClassInfo::all();
        $schedule = Shedule::where('class_id', $class_id)->orderByRaw('day_number ASC, lesson_number ASC')->get();
        $days = Day::all();
        return view('pages.admin.schedule', [
            'classes' => $classes,
            'schedule' => $schedule,
            'days' => $days,
            'current_class_id' => $class_id
        ]);
    }

    public function selectSchedule(Request $request){
        $class_id = $request->input('class_id');
        $classes = ClassInfo::all();
        $schedule = Shedule::where('class_id', $class_id)->orderByRaw('day_number ASC, lesson_number ASC')->get();
        $days = Day::all();
        return view('pages.admin.schedule', [
            'classes' => $classes,
            'schedule' => $schedule,
            'days' => $days,
            'current_class_id' => $class_id
        ]);
    }
}
