<?php

namespace App\Providers;

use App\Entities\Coin\Coin;
use App\Entities\Coin\Handbook;
use App\Observers\CoinObserver;
use App\Observers\HandbookObserver;
use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Coin::observe(CoinObserver::class);
        Handbook::observe(HandbookObserver::class);
    }
}