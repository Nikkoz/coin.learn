<?php

namespace App\Providers;

use App\Entities\Coin\Coin;
use App\Observers\CoinObserver;
use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Coin::observe(CoinObserver::class);
    }
}