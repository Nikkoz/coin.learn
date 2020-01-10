<?php


namespace App\Observers;


use App\Entities\Coin\Coin;
use Illuminate\Support\Str;

class CoinObserver
{
    public function creating(Coin $coin): void
    {
        $this->setSlug($coin);
    }

    public function updating(Coin $coin): void
    {
        $this->setSlug($coin);
    }

    /**
     * Формирует alias
     *
     * @param Coin $coin
     */
    protected function setSlug(Coin $coin): void
    {
        $coin->alias = Str::slug($coin->name);
    }
}