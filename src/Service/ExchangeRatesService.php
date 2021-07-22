<?php

namespace App\Service;

use App\CurrencyApi\ExchangeRatesApi;
use App\Entity\Rate;
use App\Repository\RateRepository;

class ExchangeRatesService
{
    /** @var ExchangeRatesApi */
    private ExchangeRatesApi $exchangeRatesApi;
    /** @var RateRepository */
    private RateRepository $rateRepo;

    public function __construct(ExchangeRatesApi $exchangeRatesApi, RateRepository $rateRepo)
    {
        $this->exchangeRatesApi = $exchangeRatesApi;
        $this->rateRepo = $rateRepo;
    }

    public function getRate(string $from, string $to, string $date): Rate
    {
        $rate = $this->rateRepo->getRate($from, $to, $date);
        if (!isset($rate))
        {
            $rateValue = $this->loadCurrencyRate($from, $to, $date);
            $rate = $this->createRate($from, $to, $date, $rateValue);
        }

        return $rate;
    }

    private function loadCurrencyRate(string $from, string $to, string $date): float
    {
        return $this->exchangeRatesApi->getRate($from, $to, $date);
    }

    private function createRate(string $from, string $to, string $date, float $rate): Rate
    {
        return $this->rateRepo->addFromArray([
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'rate' => $rate
        ]);
    }
}