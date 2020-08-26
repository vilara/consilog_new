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
    Route::get('profile', 'UserController@profileUser')->name('profile');
    Route::get('profile/senhaEdit', 'UserController@editSenha')->name('profile_edit_senha')->middleware('CheckDetailExist');
    Route::put('profile/senha/{user}', 'HomeController@updateSenha')->name('profile_update_senha');
    Route::post('profile/delete/{user}', 'HomeController@deleteUser')->name('profile_delete');
    Route::resource('rolers', 'RolerController');
    Route::resource('details', 'DetailController');
    
    
    // om
    Route::resource('oms', 'OmController')->except(['destroy']);
    Route::get('oms/delete/{om}', 'OmController@destroy')->name('om_delete');
    Route::get('/oms/subordinacao/create/{id}','OmController@CreateSubordinacaoOm');
    Route::post('/oms/subordinacao/store','OmController@StoreSubordinacaoOm');

    // endereco
    Route::resource('enderecos', 'EnderecoController')->except(['destroy']);
    Route::resource('oms.enderecos', 'OmEnderecoController'); // php artisan make:controller OmEnderecoController -r --model=Endereco --parent=Om


    // telefone
    Route::resource('telefones', 'TelefoneController');
    Route::resource('oms.telefones', 'OmTelefoneController')->except(['destroy']); // php artisan make:controller OmTelefoneController -r --model=Telefone --parent=Om
    Route::get('oms/{om}/telefones/{telefone}', 'OmTelefoneController@destroy')->name('telefone_delete');

    // views dos comandos 
    Route::resource('comandos', 'ComandoController')->except(['destroy']);
    Route::get('cmdo/delete/{comando}', 'ComandoController@destroy')->name('cmdo_delete');
    Route::get('/comandos/subordinados/{id}','ComandoController@showSubordinadas')->name('omds');
    Route::get('/home', 'HomeController@index')->name('home')->middleware('CheckDetailExist');

    // material classe v
    Route::resource('material', 'MaterialController')->except(['destroy']);
    Route::resource('vs.materials', 'ClasseVMaterialController'); // php artisan make:controller ClasseVMaterialController -r --model=Material --parent=V

    // material classe v
    Route::resource('v', 'VController')->except(['destroy']);

    // Om material controller
    Route::resource('oms.materials', 'OmMaterialController'); 

    // IRTAEx
    Route::get('irtaex/municoes/om', 'IrtaexController@ResumoMunOiiOm'); 



});
