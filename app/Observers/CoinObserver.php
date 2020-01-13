<?php

namespace App\Observers;

use App\Entities\Coin\Coin;
use App\Services\Dashboard\ImageService;
use Illuminate\Support\Str;

class CoinObserver
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function creating(Coin $coin): void
    {
        $this->setSlug($coin);
    }

    public function updating(Coin $coin): void
    {
        $this->setSlug($coin);
    }

    public function deleted(Coin $coin): void
    {
        $this->imageService->delete($coin->image);
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