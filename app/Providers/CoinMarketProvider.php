<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\Coins\CoinMarket;
use Illuminate\Contracts\Foundation\Application;

class CoinMarketProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CoinMarket::class, static function (Application $app) {
            $config = $app->make('config')->get('coin-market');

            return new $config['class']['main'](
                $config['url'],
                $config['api_key'],
                $app->make($config['class']['request']),
                $app->make($config['class']['response'])
            );
        });
    }
}