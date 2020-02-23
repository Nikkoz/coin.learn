<?php

namespace App\Contracts\Services\Query;

interface Response
{
    /**
     * Преобразует ответ в массив
     *
     * @param mixed $response
     *
     * @return mixed
     */
    public function prepare($response);
}