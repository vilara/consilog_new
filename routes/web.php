<?php

use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// personalizado por mmv
Auth::routes();


Route::get('/', function(){
    return view('auth.login');
});

Route::resource('/rolers', 'RolerController');

Route::resource('/usuarios', 'UserController');
Route::group(['middleware' => ['auth']], function(){

    Route::get('/home', 'HomeController@index')->name('home');
});
