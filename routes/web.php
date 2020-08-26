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
    //dd(request()->user());
    return view('welcome');
})->name('mainpage');

Route::get('/login','\\'.\App\Http\Controllers\AuthController::class.'@login')->middleware('guest')->name('login');
Route::post('/login','\\'.\App\Http\Controllers\AuthController::class.'@check')->middleware('guest');
Route::get('/logout','\\'.\App\Http\Controllers\AuthController::class.'@logout')->middleware('auth');

Route::get('/loginAsUser','\\'.\App\Http\Controllers\AuthController::class.'@loginAsUser');//->middleware('guest');
