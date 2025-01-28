<?php

namespace MattYeend\CurrencyExchange\Http\Controllers;

use Illuminate\Http\Requests;
use MattYeend\CurrencyExchange\Services\CurrencyExchangeService;

class CurrencyExchangeController extends Controller
{
    protected $service;

    public function __construct(CurrencyExchangeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('currencyexchange::index');
    }

    public function getRates(Request $request)
    {
        $baseCurrency = $request->input('base', config('currencyexchange.base_currency'));
        $rates = $this->service->getRates($baseCurrency);

        return response()->json(['rates' => $rates]);
    }

    public function convert(Request $request)
    {
        $amount = $request->input('amount');
        $fromCurrency = $request->input('from');
        $toCurrency = $request->input('to');

        $convertedAmount = $this->service->convert($amount, $fromCurrency, $toCurrency);

        return response()->json(['converted_amount' => $convertedAmount]);
    }
}