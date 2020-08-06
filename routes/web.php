<?php

use App\Http\Controllers\RolerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// personalizado por mmv
Auth::routes();


Route::get('/', function(){
    return view('auth.login');
});


Route::group(['middleware' => ['auth']], function(){
    Route::resource('usuarios', 'UserController')->parameters(['usuarios' => 'user']);
    // Route::get('usuarios/{$user}', 'UserController@show')->name('usuarios.show');
    Route::get('profile', 'DetailController@create')->name('profile');
    Route::resource('rolers', 'RolerController');
    Route::resource('details', 'DetailController');
    Route::get('/home', 'HomeController@index')->name('home');
});
