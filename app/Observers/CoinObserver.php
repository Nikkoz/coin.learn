<?php


namespace App\Observers;


use App\Entities\Coin\Coin;
use Illuminate\Support\Str;

class CoinObserver
{
    public function creating(Coin $coin): void
    {
        $this->setSlug($coin);
        $this->prepareJson($coin);
    }

    public function updating(Coin $coin): void
    {
        $this->setSlug($coin);
        $this->prepareJson($coin);
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

    protected function prepareJson(Coin $coin)
    {
        $link = array_filter($coin->link, static function ($item) {
            return !empty($item);
        });

        return $coin->link = json_encode($link, JSON_THROW_ON_ERROR, 512);
    }
}