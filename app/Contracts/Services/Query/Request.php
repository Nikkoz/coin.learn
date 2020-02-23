<?php

namespace App\Contracts\Services\Query;

interface Request
{
    /**
     * Отправка запроса
     *
     * @param string $method
     * @param string $url
     *
     * @return mixed
     */
    public function send(string $method, string $url);

    /**
     * Устанаваливае урл
     *
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl): void;

    /**
     * Устанаваливает заголовки запроса
     *
     * @param array $headers
     */
    public function setHeaders(array $headers): void;
}