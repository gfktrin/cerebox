<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index');

Route::get('como-participar','HomeController@howToParticipate');

Route::get('contato','ContactController@index');

Route::post('contato/enviar','ContactController@sendMessage');

Route::get('login-redirect','HomeController@loginRedirect');

Route::group(['middleware' => 'auth'],function(){

    Route::get('editar-perfil','HomeController@editUser');
    Route::post('user/edit','UserController@edit');

    Route::group(['prefix' => 'admin'],function(){

        Route::get('home','AdminController@home');

        Route::get('usuarios','AdminController@users');

    });

});
