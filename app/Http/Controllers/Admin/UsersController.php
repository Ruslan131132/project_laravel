<?php

namespace App\Http\Controllers\Admin;
use App\Models\ClassInfo;
use App\Models\Pupil;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index()
    {
        if (!Session::has('current_page') || Session::get('current_page') != 'users'){
            Session::put('current_page', 'users');
            Session::put('current_subpage', 'Teachers');
        }

        $pupils = User::where('user_type', 'Ученик')->paginate(5, ['*'], 'pupils');
        $teachers = User::where('user_type', 'Учитель')->paginate(5, ['*'], 'teachers');
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        return view('pages.admin.users', ['pupils' => $pupils, 'teachers' => $teachers, 'classes' => $classes]);
    }

    public function search(Request $request){
        Session::put('search-input', $request->input('search-user'));
        $input = Str::lower($request->input('search-user'));
        $filter_type = 'Учитель';
        $default_type = 'Ученик';
        if (Session::get('current_subpage') == 'Pupils') {
            $filter_type = 'Ученик';
            $default_type = 'Учитель';
        }

        $default = User::where('user_type', $default_type)
            ->paginate(5, ['*'], Str::lower(Session::get('current_subpage')));

        $filter = User::where('user_type', $filter_type)
            ->where(function($query) use ($input) {//используем такую конструкцию, чтобы учитывалось основное условие
                $query->whereRaw("REGEXP_SUBSTR('".$input."', name) != ''")
                    ->orWhere('name', 'like', '%'.$input.'%')
                    ->orWhereRaw("REGEXP_SUBSTR('".$input."', surname) != ''")
                    ->orWhere('surname', 'like', '%'.$input.'%')
                    ->orWhereRaw("REGEXP_SUBSTR('".$input."', patronymic) != ''")
                    ->orWhere('patronymic', 'like', '%'.$input.'%');
            })
            ->paginate(5, ['*'], Str::lower(Session::get('current_subpage')));

        $classes = ClassInfo::orderBy('name', 'asc')->get();
        return view('pages.admin.users', [
            'pupils' => $filter_type == "Ученик" ? $filter : $default,
            'teachers' => $filter_type == "Учитель" ? $filter : $default,
            'classes' => $classes
            ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|unique:users,user_id',
            'name' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
            'surname' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
            'patronymic' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
            'password' => 'required||min:5',
        ], [
            'required' => 'Поле :attribute обязательно!',
            'regex' => 'Допустимы только русские символы для поля :attribute',
            'min' => 'Минимальная длина поля :attribute - :min символов',
            'max' => 'Максимальная длина поля :attribute - :max символов',
            'numeric' => 'Допустимы только цифры',
            'unique'    => 'Пользователь с ID :input уже существует'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Ошибка валидации данных при создании пользователя');
        }

        $user = User::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'user_type' => $request->user_type,
            'img' => $request->img,
            'address' => $request->address,
            'password' => $request->password
        ]);

        if ($user) {
            if ($user->user_type == "Учитель"){
                Teacher::create([
                    'id' => $request->user_id
                ]);
            } elseif ($user->user_type == "Ученик"){
                Pupil::create([
                    'id' => $request->user_id,
                    'class_id' => $request->class_id,
                ]);
            }
            return redirect()->back()
                ->with('success', 'Пользователь с ID '.$user->user_id.' успешно добавлен');
        }

        return redirect()->back()
            ->with('error', 'Неизвестная ошибка при создании пользователя');
    }

    public function show(Request $request)
    {
        $user = User::where('user_id', $request->input('user_id'))->first();
        return response()->json([
            'user_type' => $user->user_type,
            'id' => $user->user_id,
            'surname' => $user->surname,
            'name' => $user->name,
            'patronymic' => $user->patronymic,
            'updated_at' => $user->updated_at,
            'class_id' => $user->pupil->class_id ?? $user->teacher->class->id ?? '-',
            'img' => $user->img
        ]);
    }

    public function edit(Request $request) {
        $user = User::where('user_id', $request->input('user_id'))->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
            'surname' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
            'patronymic' => 'required|regex:/^[а-яА-Я]+$/u|max:255',
        ],[
            'required' => 'Поле :attribute обязательно!',
            'regex' => 'Допустимы только русские символы для поля :attribute',
            'max' => 'Максимальная длина поля :attribute - :max символов',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Ошибка валидации при редактировании данных пользователя '. $request->input('user_id'));
        }

        $user->fill([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic
        ])->save();

        if ($request->password){//изменим пароль
            $user->fill([
                'password' => $request->password,
            ])->save();
        }

        if ($user->user_type == "Ученик") {//изменим класс
            $user->pupil->fill([
                'class_id' => $request->class_id,
            ])->save();
        }

        return redirect()->back()->with('success', 'Профиль '.$user->user_id.' обновлен!');
    }

    public function delete(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();
        $user->forceDelete();
        $delete_user = $user->user_type == "Учитель" ? $user->teacher->forceDelete() : $user->pupil->forceDelete();
        return redirect()->back()->with('success', 'Профиль '.$user->user_id.' удален!');
    }

}
