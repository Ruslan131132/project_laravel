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

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');


Route::name('user.')->group(function(){
    Route::view('/user',  'pages.user.user-main')->middleware('auth')->name('user-main');
});

Route::name('admin.')->group(function(){
    Route::view('/admin-main', 'pages.admin.admin_main')->middleware('auth')->middleware('admin')->name('admin-main');
    Route::view('/create-class',  'pages.admin.create_class')->middleware('auth')->middleware('admin')->name('create-class');
    Route::view('/create-subject',  'pages.admin.create_subject')->middleware('auth')->middleware('admin')->name('create-subject');
    Route::view('/create-employment',  'pages.admin.create_employment')->middleware('auth')->middleware('admin')->name('create-employment');
    Route::view('/create-shedule',  'pages.admin.create-shedule')->middleware('auth')->middleware('admin')->name('create-shedule');

    Route::post('/create-user', [\App\Http\Controllers\CreateUserController::class, 'save'])->name('create-user');;

});
