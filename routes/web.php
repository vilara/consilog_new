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
    Route::resource('oms.materials', 'OmMaterialController')->except(['index']); 
    Route::get('oms/materials/index', 'OmMaterialController@index')->name('oms_materials');
    Route::get('oms/materials/index/chart', 'OmMaterialController@indexChart')->name('oms_materials_chart');
    Route::post('oms/materials/index/total', 'OmMaterialController@GetOmTotal')->name('oms_materials_total');

    // IRTAEx
    Route::get('irtaex/municoes/om', 'IrtaexController@ResumoMunOiiOm')->name('resumo_irtaex'); 
    Route::get('irtaex/municoes/tot', 'IrtaexController@ResumoMunTotOm')->name('resumo_municao_irtaex'); 
    Route::get('irtaex/efetivos/tot', 'IrtaexController@ResumoEfeTotOm')->name('resumo_efetivo_irtaex'); 
        // category
    Route::resource('categories', 'IrtaexCategoryController')->except(['destroy']);
    Route::get('category/delete/{category}', 'IrtaexCategoryController@destroy')->name('category_delete');
          // oii
    Route::resource('oiis', 'IrtaexOiiController')->except(['destroy']);
    Route::get('oii/delete/{oii}', 'IrtaexOiiController@destroy')->name('oii_delete');
        //efetivos
    Route::resource('efetivos', 'IrtaexEfetivoController')->except(['destroy','create']);
    Route::get('efetivo/delete/{efetivo}', 'IrtaexEfetivoController@destroy')->name('efetivo_delete');
    Route::get('efetivo/create/{categoria}', 'IrtaexEfetivoController@create')->name('efetivo_create');
    // efetivo oii controller
    Route::resource('oiis.efetivos', 'EfetivoOiiController'); //php artisan make:controller EfetivoOiiController -r --model=IrtaexEfetivo --parent=IrtaexOii
   // Route::get('{oii}/efetivos', 'EfetivoOiiController@index')->name('efetivos_oiis');
   
   // efetivo om controller
   Route::resource('oms.efetivos', 'OmEfetivoController')->except(['index','store']); //php artisan make:controller OmEfetivoController -r --model=IrtaexEfetivo --parent=Om
   Route::get('om/efetivo', 'OmEfetivoController@index')->name('om_efetivo_index');
   Route::post('oms/efetivo', 'OmEfetivoController@store')->name('om_efetivo_store');

   // oii v controller
   Route::resource('oiis.vs', 'OiiVController'); //php artisan make:controller OiiVController -r --model=V --parent=IrtaexOii
});
