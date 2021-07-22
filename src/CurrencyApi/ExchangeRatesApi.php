<?php

namespace App\CurrencyApi;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\HttpClient;

class ExchangeRatesApi
{
    /* todo need move to .env file */
    private const BASE_URL = 'http://api.exchangeratesapi.io/v1';
    const ACCESS_KEY = '0fa3ab4f8f38712bc3bc4ddacb87c38d';

    /** @var HttpClient|CurlHttpClient */
    private $client;

    public function __construct()
    {
        $this->client = new CurlHttpClient();
    }

    public function getRate(string $from, string  $to, string $date): float
    {
        $url = ExchangeRatesApi::BASE_URL . '/' . $date;
        $request = $this->client->request('GET', $url, [
            'query' => [
                'access_key' => ExchangeRatesApi::ACCESS_KEY,
                'base' => $from,
                'symbols' => $to
            ],
        ]);

        $response = json_decode($request->getContent(), true);
        return $response['rates'][$to];
    }
}