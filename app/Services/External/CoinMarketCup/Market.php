<?php

namespace App\Services\External\CoinMarketCup;

use Illuminate\Support\Collection;
use App\Exceptions\RequestException;
use App\Contracts\Services\Query\Request;
use App\Contracts\Services\Query\Response;
use App\Contracts\Services\Coins\CoinMarket;

class Market implements CoinMarket
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    public function __construct(string $url, string $apiKey, Request $request, Response $response)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->request = $request;
        $this->response = $response;

        $this->request->setHeaders($this->headers());
    }

    public function map(array $params = []): Collection
    {
        return $this->request('cryptocurrency/map', $params);
    }

    public function info(array $params = []): Collection
    {
        return $this->request('cryptocurrency/info', $params);
    }

    public function latest(array $params = []): Collection
    {
        return $this->request('cryptocurrency/listings/latest', $params);
    }

    public function request(string $endpoint, array $params = []): Collection
    {
        $this->request->setBaseUrl($this->url . $endpoint);

        $response = $this->request->get($params);
        $result = $this->response->prepare($response);

        if ($result['status']['error_code'] > 0) {
            throw new RequestException($result['status']['error_message'], $result['status']['error_code']);
        }

        return collect($result['data']);
    }

    protected function headers(): array
    {
        return [
            'Accept'            => 'application/json',
            'Content-Type'      => 'application/json',
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ];
    }
}