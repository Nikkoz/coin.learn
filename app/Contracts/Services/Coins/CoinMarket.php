<?php

namespace App\Contracts\Services\Coins;

use Illuminate\Support\Collection;

interface CoinMarket
{
    public function map(array $params = []): Collection;

    public function info(array $params = []): Collection;

    public function latest(array $params = []): Collection;
}
