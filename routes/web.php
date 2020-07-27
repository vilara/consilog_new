<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// personalizado por mmv
Auth::routes();


Route::get('/', function(){
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('usuarios', 'UserController');
});
