<?php

namespace App\Console\Commands\Coin;

use App\Entities\Coin\Coin;
use App\Console\BaseCommand;
use App\Dictionaries\StatusDictionary;

class DeactivateCommand extends BaseCommand
{
    private   $codes       = [
        'BTC', 'ETH', 'XRP', 'BCH', 'XMR', 'ZEC', 'LTC', 'ADA', 'MIOTA', 'DASH', 'XEM', 'EOS', 'BTG', 'XLM', 'NEO',
        'TRX', 'ICX', 'QTUM', 'XRB', 'LSK', 'XVG', 'OMG', 'BCN', 'BCC', 'SC', 'PPT', 'VEN', 'STRAT', 'KCS', 'BNB',
        'USDT', 'BTS', 'ARDR', 'DOGE', 'STEEM', 'WAVES', 'ETN', 'KMD', 'SMART', 'DGB', 'ARK', 'DCR', 'PIVX', 'HSR',
        'GBYTE', 'ZCL', 'NEBL', 'FCT',
    ];

    protected $signature   = 'coin:deactivate';

    protected $description = 'Deactivate coins';

    public function handle(): int
    {
        Coin::whereNotIn('code', $this->codes)->update(['status' => StatusDictionary::DISABLED]);

        return static::OK;
    }
}