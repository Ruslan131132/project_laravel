<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
    Route::view('/admin-main',  'pages.admin.admin_main')->middleware('auth')->name('admin-main');
    Route::view('/create-class',  'pages.admin.create_class')->middleware('auth')->name('create-class');
    Route::view('/create-subject',  'pages.admin.create_subject')->middleware('auth')->name('create-subject');
    Route::view('/create-employment',  'pages.admin.create_employment')->middleware('auth')->name('create-employment');
    Route::view('/create-shedule',  'pages.admin.create-shedule')->middleware('auth')->name('create-shedule');

    Route::post('/create-user', [\App\Http\Controllers\CreateUserController::class, 'save'])->name('create-user');;

});
