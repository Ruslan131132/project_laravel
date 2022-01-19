<?php

namespace App\Http\Controllers\Admin;
use App\Models\ClassInfo;
use App\Models\Pupil;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index()
    {
        if (!Session::has('current_page')){
            Session::put('current_page', "Учитель");
        }
        $current_page = Session::get('current_page', "Учитель");
        $pupils = Pupil::paginate(5, ['*'], 'pupils');
        $teachers = Teacher::paginate(5, ['*'], 'teachers');
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        return view('pages.admin.users', ['pupils' => $pupils, 'teachers' => $teachers, 'classes' => $classes, 'current_page' => $current_page ]);
    }

    public function search(Request $request){
        Session::put('search-input', $request->input('search-user'));
        $input = Str::lower($request->input('search-user'));

        $user_type = Session::get('current_page', "Учитель");
        if ($user_type == "Учитель") {
            $pupils = Pupil::paginate(5, ['*'], 'pupils');
            $teachers = Teacher::whereRaw("REGEXP_SUBSTR('".$input."', name) != ''")
                ->orWhere('name', 'like', '%'.$input.'%')
                ->orWhereRaw("REGEXP_SUBSTR('".$input."', surname) != ''")
                ->orWhere('surname', 'like', '%'.$input.'%')
                ->orWhereRaw("REGEXP_SUBSTR('".$input."', patronymic) != ''")
                ->orWhere('patronymic', 'like', '%'.$input.'%')
                ->paginate(5, ['*'], 'teachers');
        } elseif ($user_type == "Ученик") {
            $teachers = Teacher::paginate(5, ['*'], 'teachers');
            $pupils = Pupil::whereRaw("REGEXP_SUBSTR('".$input."', name) != ''")
                ->orWhere('name', 'like', '%'.$input.'%')
                ->orWhereRaw("REGEXP_SUBSTR('".$input."', surname) != ''")
                ->orWhere('surname', 'like', '%'.$input.'%')
                ->orWhereRaw("REGEXP_SUBSTR('".$input."', patronymic) != ''")
                ->orWhere('patronymic', 'like', '%'.$input.'%')
                ->paginate(5, ['*'], 'pupils');
        }
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        return view('pages.admin.users', ['pupils' => $pupils, 'teachers' => $teachers, 'classes' => $classes, 'current_page' => $user_type ]);
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
            'user_type' => $request->user_type,
            'img' => $request->img,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            if ($user->user_type == "Учитель"){
                Teacher::create([
                    'id' => $request->user_id,
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'patronymic' => $request->patronymic,
                ]);
            } elseif ($user->user_type == "Ученик"){
                Pupil::create([
                    'id' => $request->user_id,
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'patronymic' => $request->patronymic,
                    'class_id' => $request->class_id,
                    'address' => $request->address,
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
        $user_info = $user->user_type == "Учитель" ? $user->teacher : $user->pupil;
        return response()->json([
            'user_type' => $user->user_type,
            'id' => $user_info->id,
            'surname' => $user_info->surname,
            'name' => $user_info->name,
            'patronymic' => $user_info->patronymic,
            'updated_at' => $user_info->updated_at,
            'class_id' => $user_info->class == null ? "-" : $user_info->class->id,
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

        if ($request->password){
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
        }

        if ($user->user_type == "Учитель"){
            $user->teacher->fill([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic
            ])->save();
            $user->teacher->class->fill([
                'id' => $request->class_id,
            ])->save();
        }
        else if ($user->user_type == "Ученик"){
            $user->pupil->fill([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
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

    public function set_page(Request $request){
        Session::put('current_page', $request->input('current_page') );
        return redirect()->to(route('admin.users'));
    }

}
