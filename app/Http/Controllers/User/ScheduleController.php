<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Employment;
use App\Models\Shedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(){
        if (Auth::user()->user_type == 'Ученик'){
            $schedule = Shedule::where('class_id', Auth::user()->pupil->class_id)->orderByRaw('day_number ASC, lesson_number ASC')->get();
        } else {
            $schedule = Shedule::Where(function($query)
            {
                foreach (Auth::user()->teacher->employment as $info){
                    $query->where([
                        ['class_id', $info->class_id],
                        ['subject_id', $info->subject_id],
                    ]);
                }
            })->orderByRaw('day_number ASC, lesson_number ASC')->get();
        }

        $days = Day::all();
        return view('pages.user.schedule', [
            'schedule' => $schedule,
            'days' => $days
        ]);
    }
}
