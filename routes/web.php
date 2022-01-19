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

Route::post('/file-upload', [\App\Http\Controllers\FileController::class, 'store'])->middleware('auth')->name('file-upload');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::name('user.')->group(function(){
    Route::get('/main',  [\App\Http\Controllers\User\MainController::class, 'index'])->middleware('auth')->name('main');
    Route::get('/schedule',  [\App\Http\Controllers\User\ScheduleController::class, 'index'])->middleware('auth')->name('schedule');
    Route::get('/marks',  [\App\Http\Controllers\User\MarksController::class, 'index'])->middleware('auth')->name('marks');
    Route::post('/marks',  [\App\Http\Controllers\User\MarksController::class, 'changeFilter'])->middleware('auth')->name('marks');
    Route::post('/change-mark',  [\App\Http\Controllers\User\MarksController::class, 'changeMark'])->middleware('auth')->name('change-mark');
    Route::post('/add-mark',  [\App\Http\Controllers\User\MarksController::class, 'addMark'])->middleware('auth')->name('add-mark');
    Route::get('/courses',  [\App\Http\Controllers\User\CoursesController::class, 'index'])->middleware('auth')->name('courses');
    Route::view('/olimpiads',  'pages.user.olimpiads')->middleware('auth')->middleware('auth')->name('olimps');
    Route::view('/exams',  'pages.user.exams')->middleware('auth')->middleware('auth')->name('exams');
});

Route::name('admin.')->group(function(){

    /*Маршруты для страницы "Главная"*/
    Route::get('/admin-main', [\App\Http\Controllers\Admin\MainController::class, 'index'])->middleware('auth')->middleware('admin')->name('main');

    /*Маршруты для страницы "Пользователи"*/
    Route::get('/admin-users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->middleware('auth')->middleware('admin')->name('users');
    Route::post('/admin-users', [\App\Http\Controllers\Admin\UsersController::class, 'search'])->name('search-user');
    Route::post('/create-user', [\App\Http\Controllers\Admin\UsersController::class, 'create'])->name('create-user');
    Route::post('/show-user', [\App\Http\Controllers\Admin\UsersController::class, 'show'])->name('show-user');
    Route::post('/edit-user', [\App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('edit-user');
    Route::post('/delete-user', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('delete-user');
    Route::post('/current-page', [\App\Http\Controllers\Admin\UsersController::class, 'set_page'])->name('set-page');

    /*Маршруты для страницы "Классы"*/
    Route::get('/admin-classes',  [\App\Http\Controllers\Admin\ClassesController::class, 'index'])->middleware('auth')->middleware('admin')->name('classes');
    Route::post('/create-class', [\App\Http\Controllers\Admin\ClassesController::class, 'addClass'])->name('create-class');
    Route::post('/create-course', [\App\Http\Controllers\Admin\ClassesController::class, 'addCourse'])->name('create-course');

    /*Маршруты для страницы "Предметы"*/
    Route::get('/admin-subjects',  [\App\Http\Controllers\Admin\SubjectsController::class, 'index'])->middleware('auth')->middleware('admin')->name('subjects');

    /*Маршруты для страницы "Занятость"*/
    Route::get('/admin-employment',  [\App\Http\Controllers\Admin\EmploymentController::class, 'index'])->middleware('auth')->middleware('admin')->name('employment');

    /*Маршруты для страницы "Расписание"*/
    Route::get('/admin-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'index'])->middleware('auth')->middleware('admin')->name('schedule');
    Route::post('/admin-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'selectSchedule'])->middleware('auth')->middleware('admin')->name('schedule');
    Route::post('/get-class-schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'getSchedule'])->name('get-class-schedule');
});
