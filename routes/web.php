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
    Route::get('/courses',  [\App\Http\Controllers\User\CoursesController::class, 'index'])->middleware('auth')->name('courses');
    Route::view('/olimpiads',  'pages.user.olimpiads')->middleware('auth')->middleware('auth')->name('olimps');
    Route::view('/exams',  'pages.user.exams')->middleware('auth')->middleware('auth')->name('exams');
});

Route::name('admin.')->group(function(){
    Route::view('/admin-main', 'pages.admin.main')->middleware('auth')->middleware('admin')->name('main');
    Route::get('/admin-users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->middleware('auth')->middleware('admin')->name('users');
    Route::get('/admin-classes',  [\App\Http\Controllers\Admin\ClassesController::class, 'index'])->middleware('auth')->middleware('admin')->name('classes');
    Route::get('/admin-subjects',  [\App\Http\Controllers\Admin\SubjectsController::class, 'index'])->middleware('auth')->middleware('admin')->name('subjects');
    Route::get('/admin-employment',  [\App\Http\Controllers\Admin\EmploymentController::class, 'index'])->middleware('auth')->middleware('admin')->name('employment');
    //Route::view('/admin-schedule-page',  'pages.admin.schedule')->middleware('auth')->middleware('admin')->name('schedule-page');

    Route::get('/admin-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'index'])->middleware('auth')->middleware('admin')->name('schedule');
    Route::post('/admin-schedule',  [\App\Http\Controllers\Admin\ScheduleController::class, 'selectSchedule'])->middleware('auth')->middleware('admin')->name('schedule');

    Route::post('/create-user', [\App\Http\Controllers\Admin\UsersController::class, 'save'])->name('create-user');
    Route::post('/delete-user', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('delete-user');
    Route::post('/create-class', [\App\Http\Controllers\Admin\ClassesController::class, 'addClass'])->name('create-class');
    Route::post('/create-course', [\App\Http\Controllers\Admin\ClassesController::class, 'addCourse'])->name('create-course');
    Route::post('/get-class-schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'getSchedule'])->name('get-class-schedule');
});
