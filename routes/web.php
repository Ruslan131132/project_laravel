<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

Route::get('/', function() {
    return view('pages.index');
})->name('index');

Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('index'));
})->name('logout');

/*Маршрут для Выгрузки файлов на сервер*/
Route::post('/file-upload', [\App\Http\Controllers\FileController::class, 'store'])->middleware('auth')->name('file-upload');

/*Маршрут для авторизации*/
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');

/*Маршрут для задания сессий*/
Route::post('/current-page', [\App\Http\Controllers\SessionController::class, 'setPage'])->name('set-page');
Route::post('/marks-filter', [\App\Http\Controllers\SessionController::class, 'filterMarks'])->name('marks-filter');

Route::name('user.')->group(function(){

    /*Маршруты для страницы "Главная"*/
    Route::get('/user/main',  [\App\Http\Controllers\User\MainController::class, 'index'])->middleware('auth')->name('main');

    /*Маршруты для страницы "Расписание"*/
    Route::get('/user/schedule',  [\App\Http\Controllers\User\ScheduleController::class, 'index'])->middleware('auth')->name('schedule');

    /*Маршруты для страницы "Оценки"*/
    Route::get('/user/marks',  [\App\Http\Controllers\User\MarksController::class, 'index'])->middleware('auth')->name('marks');
    Route::post('/edit-mark',  [\App\Http\Controllers\User\MarksController::class, 'edit'])->middleware('auth')->name('edit-mark');
    Route::post('/create-mark',  [\App\Http\Controllers\User\MarksController::class, 'create'])->middleware('auth')->name('create-mark');

    /*Маршруты для страницы "Курсы"*/
    Route::get('/user/courses',  [\App\Http\Controllers\User\CoursesController::class, 'index'])->middleware('auth')->name('courses');

    /*Маршруты для страницы "Олимпиады"*/
    Route::view('/user/olimpiads',  'pages.user.olimpiads')->middleware('auth')->name('olimps');

    /*Маршруты для страницы "Экзамены"*/
    Route::view('/user/exams',  'pages.user.exams')->middleware('auth')->name('exams');

});

Route::name('admin.')->group(function(){

    /*Маршруты для страницы "Главная"*/
    Route::get('/admin/main', [\App\Http\Controllers\Admin\MainController::class, 'index'])->middleware('auth')->middleware('admin')->name('main');

    /*Маршруты для страницы "Пользователи"*/
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->middleware('auth')->middleware('admin')->name('users');
    Route::post('/admin/users', [\App\Http\Controllers\Admin\UsersController::class, 'search'])->name('search-user');
    Route::post('/create-user', [\App\Http\Controllers\Admin\UsersController::class, 'create'])->name('create-user');
    Route::post('/show-user', [\App\Http\Controllers\Admin\UsersController::class, 'show'])->name('show-user');
    Route::post('/edit-user', [\App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('edit-user');
    Route::post('/delete-user', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('delete-user');

    /*Маршруты для страницы "Классы"*/
    Route::get('/admin/classes',  [\App\Http\Controllers\Admin\ClassesController::class, 'index'])->middleware('auth')->middleware('admin')->name('classes');
    Route::post('/create-class', [\App\Http\Controllers\Admin\ClassesController::class, 'create'])->name('create-class');
    Route::post('/edit-class', [\App\Http\Controllers\Admin\ClassesController::class, 'edit'])->name('edit-class');
    Route::post('/delete-class', [\App\Http\Controllers\Admin\ClassesController::class, 'delete'])->name('delete-class');

    /*Маршруты для страницы "Предметы"*/
    Route::get('/admin/subjects',  [\App\Http\Controllers\Admin\SubjectsController::class, 'index'])->middleware('auth')->middleware('admin')->name('subjects');

    /*Маршруты для страницы "Занятость"*/
    Route::get('/admin/employment',  [\App\Http\Controllers\Admin\EmploymentController::class, 'index'])->middleware('auth')->middleware('admin')->name('employment');
    Route::post('/delete-employment',  [\App\Http\Controllers\Admin\EmploymentController::class, 'delete'])->name('delete-employment');
    Route::post('/create-employment',  [\App\Http\Controllers\Admin\EmploymentController::class, 'create'])->name('create-employment');

    /*Маршруты для страницы "Расписание"*/
    Route::get('/admin/schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'index'])->middleware('auth')->middleware('admin')->name('schedule');
    Route::post('/create-schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'create'])->name('create-schedule');
    Route::post('/delete-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'delete'])->name('delete-schedule');
    Route::post('/edit-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'edit'])->name('edit-schedule');

});
