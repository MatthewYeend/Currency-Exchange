<?php

namespace MattYeend\CurrencyExchange\Services;

use GuzzleHttp\Client;
use Exception;

class CurrencyExchangeService
{
    protected $apiKey;
    protected $client;
    protected $baseUrl = 'https://api.exchangerate-api.com/v4/latest/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function getRates($baseCurrency)
    {
        try {
            $response = $this->client->get($this->baseUrl . $baseCurrency, [
                'query' => ['access_key' => $this->apiKey],
            ]);

            $data = json_decode($response->getBody(), true);

            if(isset($data['rates'])){
                return $data['rates'];
            }
            throw new Exception('Invalid response from API');
        } catch(Exception $e) {
            throw new Exception('Error fetching exchange rates: ' . $e->getMessage());
        }
    }

    public function convert($amount, $fromCurrency, $toCurrency)
    {
        $rates = $this->getRates($fromCurrency);

        if(isset($rates[$toCurrency])){
            return $amount * $rates[$toCurrency];
        }

        throw new Exception("Currency $toCurrency not found in rates");
    }
}