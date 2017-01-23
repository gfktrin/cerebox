<?php

namespace Cerebox\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Inicializando PagSeguro
        \PagSeguro\Library::initialize();
        \PagSeguro\Configuration\Configure::setEnvironment(getenv('PAGSEGURO_ENV'));//production or sandbox
        \PagSeguro\Configuration\Configure::setAccountCredentials(
            getenv('PAGSEGURO_EMAIL'),
            getenv('PAGSEGURO_TOKEN_SANDBOX')
        );


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
