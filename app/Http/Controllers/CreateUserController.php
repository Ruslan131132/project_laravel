<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateUserController extends Controller
{
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

}
