<?php

use App\Services\Query\Request\HttpRequest;
use App\Services\Query\Response\JsonResponse;
use App\Services\External\CoinMarketCup\Market;

return [
    'url'     => env('MARKET_URL'),
    'api_key' => env('MARKET_API_KEY'),
    'class'   => [
        'main'     => Market::class,
        'request'  => HttpRequest::class,
        'response' => JsonResponse::class,
    ],

];