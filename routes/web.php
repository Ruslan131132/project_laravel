<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::name('user.')->group(function(){
    Route::view('/user',  'pages.user.user-main')->middleware('auth')->name('user-main');

    Route::get('/login', function(){
//        if (Auth::check()){
//            return redirect(route('user.user-main'));
//        }
        return redirect(route('index'));
	})->name('login');

//    Route::post('/login', []);

});
