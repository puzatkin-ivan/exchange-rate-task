<?php


namespace App\Controller;
use App\CurrencyApi\ExchangeRatesApi;
use App\Service\ExchangeRatesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExchangeRateController extends AbstractController
{
    /** @var ExchangeRatesService */
    private ExchangeRatesService $service;

    public function __construct(ExchangeRatesService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/exchange-rate")
     * @param Request $request
     */
    public function getRate(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $date = $request->get('date');

        $rate = $this->service->getRate($from, $to, $date);

        return $this->json($rate->toArray());
    }
}