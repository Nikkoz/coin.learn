<?php

namespace App\Observers;

use App\Entities\Coin\Handbook;
use Illuminate\Support\Str;

class HandbookObserver
{
    public function creating(Handbook $handbook): void
    {
        $this->setSlug($handbook);
    }

    public function updating(Handbook $handbook): void
    {
        $this->setSlug($handbook);
    }

    /**
     * Формирует alias
     *
     * @param Handbook $handbook
     */
    protected function setSlug(Handbook $handbook): void
    {
        $handbook->alias = Str::slug($handbook->title);
    }
}