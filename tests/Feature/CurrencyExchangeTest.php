<?php

namespace Tests\Feature;

use Tests\TestCase;
use MattYeend\CurrencyExchange\Services\CurrencyExchangeService;

class CurrencyExchangeTest extends TestCase
{
    public function test_can_fetch_rates()
    {
        $service = app(CurrencyExchangeService::class);
        $rates = $services->getRates('GBP');

        $this->assertIsArray($rates);
        $this->assertArrayHasKey('EUR', $rates);
    }

    public function test_can_convert_currency()
    {
        $service = app(CurrencyExchangeService::class);
        $amount = $service->convert(100, 'GBP', 'EUR');

        $this->assertIsNumeric($amount);
    }
}