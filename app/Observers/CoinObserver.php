<?php

namespace App\Observers;

use App\Entities\Coin\Coin;
use Illuminate\Support\Str;
use App\Services\Dashboard\ImageService;
use App\Filters\EloquentDataFilterResolver;

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

    public function saving(Coin $coin): void
    {
        $filterResolver = new EloquentDataFilterResolver($coin);
        $filterResolver->resolve();
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