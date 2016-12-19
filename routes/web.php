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
	return view('welcome')->with([
		'contests' => Cerebox\Contest::where('begins_at', '<=', date('Y-m-d H:i:s'))
			->where('ends_at', '>=', date('Y-m-d H:i:s'))
			->get(),
	]);
});

Auth::routes();

Route::get('home', 'HomeController@index');
Route::get('como-participar', 'HomeController@howToParticipate');
Route::get('login-redirect', 'HomeController@loginRedirect');
Route::get('concurso/{slug}', 'HomeController@contest');

Route::get('contato', 'ContactController@index');
Route::post('contato/enviar', 'ContactController@sendMessage');

Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::group(['middleware' => 'auth'], function () {

	Route::get('editar-perfil', 'HomeController@editUser');
	Route::get('concurso/{contest}/enviar-projeto', 'HomeController@submitProject');
	Route::get('meus-projetos', 'HomeController@myProjects');

	Route::post('usuario/editar', 'UserController@edit');
	Route::post('projeto/criar', 'ProjectController@create');

	//Admin com prefixo
	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
		Route::get('/', function () {
			return redirect('admin/home');
		});

		Route::get('home', 'AdminController@home');
		Route::get('usuarios', 'AdminController@users');
		Route::get('usuario/{user}', 'AdminController@retrieveUser');
		Route::get('concursos', 'AdminController@contests');
		Route::get('concurso/criar', 'AdminController@createContest');
		Route::get('concurso/{contest}', 'AdminController@retrieveContest');

		Route::get('project/{project}/approve', 'ProjectController@approve');
		Route::get('project/{project}/refuse', 'ProjectController@refuse');

	});

	//Admin sem prefixo
	Route::group(['middleware' => 'admin'], function () {
		Route::post('concurso/criar', 'ContestController@create');
		Route::post('concurso/{contest}/editar', 'ContestController@update');
		Route::post('concurso/{contest}/apagar', 'ContestController@delete');
	});
});
