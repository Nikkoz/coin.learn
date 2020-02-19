<?php

namespace App\Console\Commands\Coin;

use App\Entities\Coin\Coin;
use App\Console\BaseCommand;
use App\Managers\CoinMarketManager;
use App\Services\Dashboard\CoinService;

class ImportCommand extends BaseCommand
{
    protected $signature   = 'coin:import {--all}';

    protected $description = 'Import coins from market';

    private   $service;

    private   $manager;

    public function __construct(CoinService $service, CoinMarketManager $manager)
    {
        parent::__construct();

        $this->service = $service;
        $this->manager = $manager;
    }

    public function handle()
    {
        $all = (bool)$this->option('all');

        $coins = $this->manager->import($all);

        $coins->each(function (array $coin) {
            $model = Coin::firstOrNew(['market_id' => 1]);

            $this->service->save($model, $coin);
        });
    }
}
