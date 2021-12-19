<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Employment;
use App\Models\Mark;
use App\Models\Pupil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MarksController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'Учитель') {
            $classes = Employment::distinct()->where('teacher_id', Auth::user()->user_id)->get(['class_id']);

            $selected_class_id = Session::has('current_class_id') ?
                Session::get('current_class_id', 0) :
                Session::put('current_class_id', $classes->first()->class_id);
            $subjects_for_selected_class = Auth::user()->teacher->employment->where('class_id', $selected_class_id);
            $selected_subject_id = Session::has('current_subject_id') ?
                Session::get('current_subject_id', 0) :
                Session::put('current_subject_id', $subjects_for_selected_class->first()->subject_id);
            $pupils = Pupil::where('class_id', $selected_class_id)->orderBy('surname', 'asc')->get();
            $marks_info = Mark::where('subject_id', $selected_subject_id)
                ->whereIn('pupil_id', $pupils->pluck('id')->toArray())
                ->get()
                ->sortBy(function ($info) {
                    return $info->pupil->surname;
                })
                ->sortBy(function ($info) {
                    return $info->created_at;
                });
            return view('pages.user.marks', [
                'classes_info' => $classes,
                'current_class_id' => $selected_class_id,
                'subjects_info' => $subjects_for_selected_class,
                'current_subject_id' => $selected_subject_id,
                'pupils' => $pupils,
                'marks_info' => $marks_info
            ]);
        } else {
            $subjects_info = Employment::distinct()->where('class_id', Auth::user()->pupil->class_id)->get(['subject_id']);
            $marks_info = Mark::where('pupil_id', Auth::user()->user_id)
                ->get()
                ->sortBy(function ($info) {
                    return $info->subject->name;
                })
                ->sortBy(function ($info) {
                    return $info->created_at;
                });
//            dd($subjects);
            return view('pages.user.marks', [
                'marks_info' => $marks_info,
                'subjects_info' => $subjects_info
            ]);
        }
    }

    public function changeFilter(Request $request){
        $classes = Employment::distinct()->where('teacher_id', Auth::user()->user_id)->get(['class_id']);
        $selected_class_id = $request->input('class_id');
        $selected_subject_id = $request->input('subject_id');
        Session::put('current_class_id', $selected_class_id);
        Session::put('current_subject_id', $selected_subject_id);
        $subjects_for_selected_class = Auth::user()->teacher->employment->where('class_id', $selected_class_id);
        $pupils = Pupil::where('class_id', $selected_class_id)->orderBy('surname', 'asc')->get();
        $marks_info = Mark::where('subject_id', $selected_subject_id)
            ->whereIn('pupil_id', $pupils->pluck('id')->toArray())
            ->get()
            ->sortBy(function($info) {
                return $info->pupil->surname;
            })
            ->sortBy(function($info) {
                return $info->created_at;
            });
        return view('pages.user.marks', [
            'classes_info' => $classes,
            'current_class_id' => $selected_class_id,
            'subjects_info' => $subjects_for_selected_class,
            'current_subject_id' => $selected_subject_id,
            'pupils' => $pupils,
            'marks_info' => $marks_info
        ]);
    }

    public function addMark(Request $request){
        $mark = Mark::create([
            'mark' => $request->input('mark'),
            'pupil_id' => $request->input('pupil_id'),
            'subject_id' => Session::get('current_subject_id', 0)
        ]);

        return redirect()->route('user.marks');
    }

    public function changeMark(Request $request){
        $mark = $request->input('mark');
        if ($mark == null) {
            $deleteMark = Mark::where('id', $request->input('id'))->delete();
        }

        $updateMark = Mark::where('id', $request->input('id'))->update(['mark' => $mark]);

        return redirect()->route('user.marks');
    }

}
