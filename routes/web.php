<?php

use Illuminate\Support\Facades\Route;
use MattYeend\CurrencyExchange\Http\Controllers\CurrencyExchangeController;

Route::get('/currency-exchange', [CurrencyExchangeController::class, 'index'])->name('currencyexchange.index');
Route::get('/currency-exchange/rates', [CurrencyExchangeController::class, 'getRates'])->name('currencyexchange.rates');
Route::post('/currency-exchange/convert', [CurrencyExchangeController::class, 'convert'])->name('currencyexchange.convert');