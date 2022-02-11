<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Employment;
use App\Models\Mark;
use App\Models\Pupil;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Symfony\Component\String\s;

class MarksController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'Учитель') {
            $schedule = Auth::user()->teacher->schedule;//классы в которых преподает текущий учитель

            $classes = array_unique($schedule->map(function ($data){
                return (object) ['id' => $data->class->id, 'name' => $data->class->name];
            })->toArray(), SORT_REGULAR);//получили список всех классов в уникальном виде

            if(!Session::has('current_class_id')){
                Session::put('current_class_id', $classes[0]->id);
            }

            $subjects = array_unique($schedule->where('class_id', Session::get('current_class_id'))->map(function ($data){
                return (object) ['id' => $data->subject->id, 'name' => $data->subject->name];
            })->toArray(), SORT_REGULAR);//получили список всех предметов в уникальном виде

            if(!Session::has('current_subject_id')){
                Session::put('current_subject_id', $subjects[0]->id);
            }

            $pupils = Pupil::where('class_id', Session::get('current_class_id'))->get()->sortBy(function ($info) {
                return $info->user->surname;
            });

            $marks = Mark::where('subject_id', Session::get('current_subject_id'))
                ->whereIn('pupil_id', $pupils->pluck('id')->toArray())
                ->get()
                ->sortBy(function ($info) {
                    return $info->pupil->surname;
                })
                ->sortBy(function ($info) {
                    return $info->created_at;
                });
            return view('pages.user.marks', [
                'classes' => $classes,
                'subjects' => $subjects,
                'pupils' => $pupils,
                'marks' => $marks
            ]);
        } else {
            $subjects = array_unique(Auth::user()->pupil->class->schedule->where('class_id', Auth::user()->pupil->class_id)->map(function ($data){
                return (object) ['id' => $data->subject->id, 'name' => $data->subject->name];
            })->toArray(), SORT_REGULAR);//получили список всех предметов в уникальном виде

            usort($subjects, function($a, $b)
            {
                return strcmp($a->name, $b->name);
            });//сортируем по названию предмета

            $marks = Mark::where('pupil_id', Auth::user()->user_id)
                ->get()
                ->sortBy(function ($info) {
                    return $info->subject->name;
                })
                ->sortBy(function ($info) {
                    return $info->created_at;
                });
            return view('pages.user.marks', [
                'marks' => $marks,
                'subjects' => $subjects
            ]);
        }
    }

    public function create(Request $request){
        $mark = Mark::create([
            'mark' => $request->input('mark'),
            'pupil_id' => $request->input('pupil_id'),
            'subject_id' => Session::get('current_subject_id', 0)
        ]);

        return redirect()->route('user.marks');
    }

    public function edit(Request $request){
        $mark = $request->input('mark');
        if ($mark == null) {
            $deleteMark = Mark::where('id', $request->input('id'))->delete();
        }

        $updateMark = Mark::where('id', $request->input('id'))->update(['mark' => $mark]);

        return redirect()->route('user.marks');
    }

}
