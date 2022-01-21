<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInfo;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    public function index(){
        if (!Session::has('current_page') || Session::get('current_page') != 'classes'){
            Session::put('current_page', 'classes');
            Session::put('current_subpage', 'Classes');
        }

        $teachers_without_class = Teacher::whereNotIn('id', function ($query) {
            $query->selectRaw('teacher_id')->from('classes');
        })->orderBy('surname', 'asc')->get();
        $teachers = Teacher::orderBy('surname', 'asc')->get();
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        $courses = Course::all();
        return view('pages.admin.classes', [
            'teachers' => $teachers,
            'classes' => $classes,
            'courses' => $courses,
            'teachers_without_class' => $teachers_without_class,
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'teacher_id' => $request->type == "Class" ? 'required|numeric|unique:classes,teacher_id' : 'required|numeric',
            'class_name' => $request->type == "Class" ? 'required|max:40|unique:classes,name' : 'required|max:40',
            'price' => $request->type == "Course" ? 'required|numeric' : '',
            'description' => $request->type == "Course" ? 'required|min:20|max:150' : '',
            'training_period' => $request->type == "Course" ? 'required|min:10|max:50' : '',
        ], [
            'required' => 'Поле :attribute обязательно!',
            'regex' => 'Допустимы только русские символы для поля :attribute',
            'min' => 'Минимальная длина поля :attribute - :min символов',
            'max' => 'Максимальная длина поля :attribute - :max символов',
            'price.numeric' => 'В поле СТоимость допустимы только цифры',
            'class_name.unique'    => 'Класс :input уже существует',
            'teacher_id.unique'    => 'У выбранного преподавателя(:input) уже есть класс!'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Ошибка валидации данных при добавлении записи');
        }

        if ($request->type == "Class"){
            ClassInfo::create([
                'name' => $request->class_name,
                'teacher_id' => $request->teacher_id,
            ]);
            return back()->with('success', 'Класс успешно добавлен!');
        } elseif ($request->type == "Course") {
            Course::create([
                'name' => $request->class_name,
                'description' => $request->description,
                'img' => $request->img,
                'price' => $request->price,
                'training_period' => $request->training_period,
                'teacher_id' => $request->teacher_id,
            ]);
            return back()->with('success', 'Курс успешно добавлен!');
        }
        return back()->with('warning', 'Неизвестная ошибка - попробуйте обновить страницу');
    }

    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|numeric',
            'class_id' => 'required|numeric',
            'price' => Session::get('current_subpage') == "Courses" ? 'required|numeric' : '',
            'description' => Session::get('current_subpage') == "Courses" ? 'required|min:20|max:150' : '',
            'training_period' => Session::get('current_subpage') == "Courses" ? 'required|min:10|max:50' : '',
        ], [
            'required' => 'Поле :attribute обязательно!',
            'min' => 'Минимальная длина поля :attribute - :min символов',
            'max' => 'Максимальная длина поля :attribute - :max символов',
            'price.numeric' => 'В поле Стоимость допустимы только цифры',
            'class_id.numeric' => 'Ошибка редактирования - данное поле скомпрометировано',
            'teacher_id.numeric' => 'Ошибка редактирования - данное поле скомпрометировано',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Ошибка валидации данных при добавлении записи');
        }

        if (Session::get('current_subpage') == 'Classes'){
            $class = ClassInfo::where('id', $request->input('class_id'))->first();
            $class->fill([
                    'teacher_id' => $request->teacher_id
                ])->save();

            return back()->with('success', 'Данные по классу '.$class->name .' обновлены');
        } elseif (Session::get('current_subpage') == 'Courses') {
            $course = Course::where('id', $request->input('class_id'))->first();
            $course->fill([
                'description' => $request->description,
                'price' => $request->price,
                'training_period' => $request->training_period,
                'teacher_id' => $request->teacher_id
            ])->save();
            return back()->with('success', 'Данные по курсу '.$course->name .' обновлены');
        }
        return back()->with('warning', 'Неизвестная ошибка - попробуйте обновить страницу');
    }

    public function delete(Request $request){
        if (Session::get('current_subpage') == 'Classes'){
            ClassInfo::where('id', $request->input('class_id'))->first()->forceDelete();
            return back()->with('success', 'Данные по классу удалены');
        } elseif (Session::get('current_subpage') == 'Courses') {
            Course::where('id', $request->input('class_id'))->first()->forceDelete();
            return back()->with('success', 'Данные по курсу удалены');
        }
        return back()->with('warning', 'Неизвестная ошибка - попробуйте обновить страницу');
    }

}
