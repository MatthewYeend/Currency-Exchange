<?php

namespace MattYeend\CurrencyExchange;

use Illuminate\Support\ServiceProvider;

class CurrencyExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/currencyexchange.php', 'currencyexchange');

        $this->app->singleton(CurrencyExchangeService::class, function($app){
            return new CurrencyExchangeService(config(currencyexchange.api_key));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/currencyexchange.php' => config_path('currencyexchange.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'currencyexchange');
    }
}