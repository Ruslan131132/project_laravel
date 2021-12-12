<?php

namespace App\Http\Controllers\Admin;
use App\Models\ClassInfo;
use App\Models\Pupil;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function index()
    {
        $pupils = Pupil::paginate(10);
        $teachers = Teacher::paginate(10);
        $classes = ClassInfo::orderBy('name', 'asc')->get();
        return view('pages.admin.users', ['pupils' => $pupils, 'teachers' => $teachers, 'classes' => $classes ]);
    }

    public function save(Request $request){

//        if (!Auth::check()) {
//            return redirect(route('index'))->withErrors([
//                'formError' => 'Время вашего сеанса истекло'
//            ]);
//        }
        $validateFields = $request->validate([
            'user_id' => 'required|numeric',
            'user_type' => 'required',
            'password' => 'required',
        ]);

        $user = User::create($validateFields);
        if ($user) {
            return redirect()->to(route('admin.admin-main'));
        }

        return redirect(route('admin.create-user'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }

    public function delete()
    {
        $pupils = Pupil::paginate(10);
        $teachers = Teacher::paginate(10);
        $classes = ClassInfo::orderBy('name', 'asc')->get();

        return view('pages.admin.users', ['pupils' => $pupils, 'teachers' => $teachers, 'classes' => $classes ]);
    }

}
