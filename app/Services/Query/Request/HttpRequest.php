<?php

namespace App\Services\Query\Request;

use GuzzleHttp\Client;
use App\Exceptions\RequestException;
use Psr\Http\Message\StreamInterface;
use App\Contracts\Services\Query\Request;

class HttpRequest implements Request
{
    private $baseUrl = '';

    private $headers = [];

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $params
     *
     * @throws RequestException
     * @return StreamInterface
     */
    public function send(string $method = 'GET', string $url = '', array $params = [])
    {
        if (empty($url)) {
            throw new RequestException('Base url is empty.');
        }

        return $this->client->request($method, $url, [
            'headers' => $this->headers,
            'query'   => $params,
        ])->getBody();
    }

    public function get(array $params = [])
    {
        return $this->send('GET', $this->baseUrl, $params);
    }

    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}