<?php

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
//    return view('welcome');
    return view('auth.loginOptica');
});
Route::post('/loginSys','Auth\LoginController@login')->name('loginSys');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//----Rutas del sistema
Route::group(['prefix'=>'/adm'],function (){
    Route::get('/','HomeController@indexSystema')->name('indexSystema');
    Route::group(['prefix'=>'/perfil-user'],function (){
        Route::get('/','usersController@perfilUser')->name('perfilUser');
        Route::get('/refreshPerfil','usersController@perfilUserRefresh');
        Route::post('/update','usersController@updatePerfil');
    });
    //Rutas gestion de usuarios
    Route::group(['prefix'=>'/usuarios'],function (){
        Route::get('home','usersController@index')->name('user_home');
        Route::post('create','usersController@create');
        Route::get('store','usersController@store');
        Route::get('/show/{id}','usersController@show');
        Route::post('/update/','usersController@update');
        Route::get('/destroy/{id}','usersController@destroy');
        Route::get('/gestAcceso/{id}','usersController@gestAcceso');
   });
    //rutas gestion de clientes
    Route::group(['prefix'=>'/clientes'],function (){
        Route::get('/home','ClientesController@index')->name('clientes_home');
        Route::post('/create','ClientesController@create');
        Route::get('/store','ClientesController@store');
        Route::get('/edit/{id}','ClientesController@edit');
        Route::post('/update','ClientesController@update');
        Route::get('/destroy/{id}','ClientesController@destroy');
        Route::get('historiClie/{id}','ClientesController@historiClie');
        Route::get('historiClieDetalle/{id}','ClientesController@historiClieDetalle');

    });
    //Rutas gestion de atencion
    Route::group(['prefix'=>'/Atencion'],function (){
        Route::get('home','AtencionController@index')->name('atencion_home');
        Route::get('busc1/{ci}','AtencionController@busc1');
        Route::get('busc2/{text}','AtencionController@busc2');
        Route::post('create','AtencionController@create');
//        RUTAS PARA VENTAS PASADAS
        Route::get('ventas-Anteriores','ventRealiController@index')->name('ventasPasadas_home');
        Route::post('ventas-Anteriores1','ventRealiController@list1');
        Route::post('ventas-Anteriores2','ventRealiController@list2');

    });
    Route::group(['prefix'=>'/AtenPendientes'],function (){
        Route::get('/','AtenPendienteController@index')->name('AtenPendientes_home');
        Route::get('storePendientes','AtenPendienteController@storePendientes');
        Route::get('store/{id}','AtenPendienteController@show');
        Route::get('destroy/{id}','AtenPendienteController@destroy');
        Route::post('update/{id}','AtenPendienteController@update');
        Route::get('atenPagada/{id}','AtenPendienteController@atenPagada');
    });
    Route::group(['prefix'=>'/VentasPasadas'],function (){
        Route::get('/','ventPasaController@index')->name('VentPasad_home');
    });
    Route::group(['prefix'=>'/Reportes'],function (){
        Route::get('/','reporteController@index')->name('reportes_home');
        Route::get('listar','reporteController@store');
    });
});

