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

Route::get('/', '\\'.\App\Http\Controllers\HomeController::class)
    ->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login','\\'.\App\Http\Controllers\AuthController::class.'@login')
        ->name('login');
    Route::post('/login','\\'.\App\Http\Controllers\AuthController::class.'@check');

    Route::get('/{id}','\\'.\App\Http\Controllers\AdController::class.'@showOne')
        ->where('id', '[0-9]+');
});



// This route for testing
Route::get('/loginAsUser','\\'.\App\Http\Controllers\AuthController::class.'@loginAsUser');//->middleware('guest');

Route::middleware('auth')->group(function(){
    Route::get('/logout','\\'.\App\Http\Controllers\AuthController::class.'@logout')
        ->middleware('auth')
        ->name('logout');

    Route::middleware(\App\Http\Middleware\CheckAdAuthor::class)->group(function(){
        Route::get('/edit/{id?}','\\'.\App\Http\Controllers\AdController::class.'@create')
            ->name('ad.create');

        Route::post('/edit/{id?}','\\'.\App\Http\Controllers\AdController::class.'@save');

        Route::get('/delete/{id}','\\'.\App\Http\Controllers\AdController::class.'@delete')
            ->where('id', '[0-9]+')
            ->name('ad_delete');

    });
});


