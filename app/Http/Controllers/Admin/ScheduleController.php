<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use App\Models\ClassInfo;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    public function index(){
        if (!Session::has('current_page') || Session::get('current_page') != 'schedule'){
            Session::put('current_page', 'schedule');
            Session::put('current_subpage', '1');//подстраница это id класса
        }
        $class_id = Session::get('current_subpage');
        $classes = ClassInfo::all();
        $schedule = Schedule::where('class_id', $class_id)->orderByRaw('day_number ASC, lesson_number ASC')->get();
        $days = Day::all();
        $lessons = Lesson::all()->map(function($lesson) {
            return substr($lesson->start_time, 0, -3).'-'.substr($lesson->end_time, 0, -3);
        });

        return view('pages.admin.schedule', [
            'classes' => $classes,
            'schedule' => $schedule,
            'days' => $days,
            'teachers' => User::where('user_type', 'Учитель')->get(),
            'subjects' => Subject::all(),
            'cabinets' => Cabinet::all(),
            'lessons' => $lessons
        ]);
    }

    public function create(Request $request){
        //проверяем занят ли кабинет в указанный день
        if ($check_schedule = Schedule::where([
            'day_number' => $request->day_number,
            'lesson_number' => $request->lesson_number,
            'cabinet_id' => $request->cabinet_id
        ])->first()){
            Session::flash('error', 'В указанное время кабинет "' . $check_schedule->cabinet->name . '" занят классом ' . $check_schedule->class->name);
            return response()->json(array('message'=> 'В указанное время кабинет "' . $check_schedule->cabinet->name . '" занят классом ' . $check_schedule->class->name ));
        }

        //проверяем - нет ли у выбранных преподавателей занятости в это время
        foreach (Teacher::whereIn('id', $request->teachers)->get() as $teacher){
            if ($teacher->schedule
                ->where('day_number', $request->day_number)
                ->where('lesson_number', $request->lesson_number)
                ->first()
            ){
                Session::flash('error', 'В указанное время преподаватель '.$teacher->user->surname.' '.$teacher->user->name.' '.$teacher->user->patronymic.' занят');
                return response()->json(array('message'=> 'В указанное время преподаватель '.$teacher->user->surname.' '.$teacher->user->name.' '.$teacher->user->patronymic.' занят'));
            }
        }

        $schedule = Schedule::create([
            'class_id' => Session::get('current_subpage'),//  данные о текущем классе хранятся в сессии в виде подстраницы,
            'subject_id' => $request->subject_id,
            'day_number' => $request->day_number,
            'lesson_number' => $request->lesson_number,
            'cabinet_id' => $request->cabinet_id
        ]);

        //добавляем переданных преподавателей
        $schedule->teacher()->attach($request->teachers);

        Session::flash('success', ("Данные успешно добавлены!"));
        return response()->json([
            'success' => true,
            'message'=> 'Данные успешно добавлены'
        ]);
    }

    public function edit(Request $request){
        $schedule = Schedule::where('id', $request->input('schedule_id'))->first();

        if (!$schedule){
            Session::flash('error', ("Ошибка - информация не найдена!"));
            return response()->json(array('message'=> 'Ошибка - информация не найдена!'), 404);
        }

        //проверяем занят ли кабинет в указанный день
        if ($check_schedule = Schedule::where([
            'day_number' => $schedule->day_number,
            'lesson_number' => $schedule->lesson_number,
            'cabinet_id' => $request->cabinet_id,
            ['id', '<>', $schedule->id]
        ])->first()){
            Session::flash('error', 'В указанное время кабинет "' . $check_schedule->cabinet->name . '" занят классом ' . $check_schedule->class->name);
            return response()->json(array('message'=> 'В указанное время кабинет "' . $check_schedule->cabinet->name . '" занят классом ' . $check_schedule->class->name ));
        }
        if($request->teachers){
            //проверяем - нет ли у выбранных преподавателей занятости в это время
            foreach (Teacher::whereIn('id', $request->teachers)->get() as $teacher){
                if ($teacher->schedule
                    ->where('day_number', $schedule->day_number)
                    ->where('lesson_number', $schedule->lesson_number)
                    ->first()
                ){
                    Session::flash('error', 'В указанное время преподаватель '.$teacher->user->surname.' '.$teacher->user->name.' '.$teacher->user->patronymic.' занят');
                    return response()->json(array('message'=> 'В указанное время преподаватель '.$teacher->user->surname.' '.$teacher->user->name.' '.$teacher->user->patronymic.' занят'));
                }
            }
        }


        //Обновляем
        $schedule->update([
            'subject_id' => $request->subject_id,
            'cabinet_id' => $request->cabinet_id
        ]);

        //Удаляем старые записи и добавляем новые
        $schedule->teacher()->sync($request->teachers);
        Session::flash('success', ("Данные успешно обновлены!"));
        return response()->json(['success' => true, 'message'=> 'Данные успешно обновлены']);
    }

    public function delete(Request $request){

        $schedule = Schedule::find($request->schedule_id);
        if ($pivot = $schedule->teacher()){
            $pivot->detach();
        };
        $schedule->forceDelete();

        if($schedule->trashed()){
            return response()->json([
                'warning' => true,
                'message'=> 'Ошибка удаления',
            ]);
        }
        Session::flash('success', ("Данные успешно удалены!"));
        return response()->json([
            'success' => true,
            'message'=> 'Данные успешно удалены',
            'is_tr' => $schedule->trashed()
        ]);
    }
}
