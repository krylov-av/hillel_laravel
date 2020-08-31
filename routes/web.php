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

Route::get('/', '\\'.\App\Http\Controllers\HomeController::class)->name('home');

Route::get('/{id}',function($id){
    $ad = \App\Ad::findOrFail($id);
    return view('ad',['ad'=>$ad]);
})->where('id', '[0-9]+');

Route::get('/login','\\'.\App\Http\Controllers\AuthController::class.'@login')->middleware('guest')->name('login');
Route::post('/login','\\'.\App\Http\Controllers\AuthController::class.'@check')->middleware('guest');
Route::get('/logout','\\'.\App\Http\Controllers\AuthController::class.'@logout')->middleware('auth')->name('logout');

Route::get('/loginAsUser','\\'.\App\Http\Controllers\AuthController::class.'@loginAsUser');//->middleware('guest');

Route::get('/delete/{id}',function($id){
    $ad = \App\Ad::findOrFail($id);
    $user = auth()->user();

    // check permissions
    $access = $user->can('delete',$ad);

    if ($access)
    {
        $ad->delete();
        // redirect to home with success message
        return redirect()->route('home')->with('success','Ad "' .$ad->title. '" was successfuly deleted');
    }
    else
    {
        // redirect to home with error message
        return redirect()->route('home')->with('error','Ad "'.$ad->title.'" can not be deleted, because you are not author');
    }

})->where('id', '[0-9]+')->name('ad_delete');

Route::get('/create',function(){
    return view('ad-form');
})->name('ad.create');

Route::post('/create',function(){
    $validator = \Illuminate\Support\Facades\Validator::make(
        request()->all(),
        [
            'title' => 'required|min:5|max:15',
            'description' => ['required','min:5','max:20']
        ]
    );
    if ($validator->fails())
    {
        return redirect('/create')
            ->withErrors($validator->errors())
            ->withInput(request()->all());
    }
    $ad = new \App\Ad;
    $ad->title = request()->get('title');
    $ad->description = request()->get('description');
    //1
    //$ad->user_id = auth()->user()->id;
    //$ad->save();

    //2
    auth()->user()->ads()->save($ad);
    /////Redirect to main page
    return redirect()->route('home')->with('success','Ad "' .$ad->title. '" was successfuly created');
});
