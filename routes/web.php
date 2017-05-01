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

Route::get('/', 'HomeController@index');

Route::get('teste',function(){
    $notification_code = 'BC00D52EF29BF29BDBDFF4567FA9183BCA81';

    $response = \PagSeguro\Services\Application\Search\Notification::search(
        \PagSeguro\Configuration\Configure::getAccountCredentials(),
        $notification_code);

    dd($response);

});

Auth::routes();

//Route::get('home', 'HomeController@index');
Route::get('como-participar', 'HomeController@howToParticipate');
Route::get('retorno-pagamento', 'HomeController@paymentReturn');
Route::get('concursos-abertos', 'HomeController@openContests');
Route::get('concurso/{slug}', 'HomeController@contest');

Route::get('contato', 'ContactController@index');
Route::post('contato/enviar', 'ContactController@sendMessage');

Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('fatura/retorno','InvoiceController@paymentReturn');
Route::any('fatura/notificacao','InvoiceController@notification');

Route::get('fatura/{invoice}/pagar','InvoiceController@pay');

Route::get('estado/{state}/cidades','StateController@getCities');

Route::group(['middleware' => 'auth'], function () {
    Route::get('login-redirect', 'HomeController@loginRedirect');

    Route::get('adquirir-tickets','HomeController@acquireTickets');

    Route::post('compras/criar','PurchaseController@create');

	Route::get('editar-perfil', 'HomeController@editUser');
	Route::get('concurso/{contest}/enviar-projeto', 'HomeController@submitProject');
	Route::get('meus-projetos', 'HomeController@myProjects');

    Route::post('usuario/{user}/editar', 'UserController@edit');
    Route::post('projeto/criar', 'ProjectController@create');
    Route::post('projeto/enviar','ProjectController@submit');

    Route::post('projeto/votar','ProjectController@vote');
    Route::get('projeto/{project}/remover-voto','ProjectController@removeVote');

    //Admin com prefixo
	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
		Route::get('/', function () {
			return redirect()->action('AdminController@home');
		});

		Route::get('home', 'AdminController@home');
		
		Route::get('usuarios', 'AdminController@users');
		Route::get('usuario/{user}', 'AdminController@retrieveUser');
		
		Route::get('concursos', 'AdminController@contests');
		Route::get('concurso/criar', 'AdminController@createContest');
		Route::get('concurso/{contest}', 'AdminController@retrieveContest');
		Route::get('concurso/{contest}/computar', 'AdminController@makePositions');
		Route::get('concurso/{contest}/ranking/download','ContestController@rankingSpreadSheet');

		Route::get('concurso/tema/criar', 'AdminController@createTheme');
		Route::get('concurso/tema','AdminController@retrieveTheme');
        
		Route::get('compras','AdminController@purchases');
		Route::get('compra/{purchase}','AdminController@retrievePurchase');

        Route::get('fatura/{invoice}','AdminController@retrieveInvoice');

		Route::get('project/{project}/approve', 'ProjectController@approve');
		Route::get('project/{project}/refuse', 'ProjectController@refuse');
        Route::get('project/{project}/delete', 'ProjectController@delete');
	});

	//Admin sem prefixo
	Route::group(['middleware' => 'admin'], function () {
		Route::post('concurso/criar', 'ContestController@create');
		Route::post('concurso/{contest}/editar', 'ContestController@update');
		Route::post('concurso/{contest}/apagar', 'ContestController@delete');

		Route::post('concurso/tema/criar', 'ThemeController@create');
		Route::post('concurso/tema/editar', 'ThemeController@update');
		Route::post('concurso/tema/apagar',  'ThemeController@delete');

		Route::post('fatura/{invoice}/editar','InvoiceController@update');
		Route::get('fatura/{invoice}/sincronizar-meio-de-pagamento','InvoiceController@updateStatus');
	});
});