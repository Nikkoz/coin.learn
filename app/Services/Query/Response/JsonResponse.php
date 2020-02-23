<?php

namespace App\Services\Query\Response;

use App\Contracts\Services\Query\Response;

class JsonResponse implements Response
{
    public function prepare($response)
    {
        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }
}