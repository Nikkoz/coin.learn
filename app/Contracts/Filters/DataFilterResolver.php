<?php

namespace App\Contracts\Filters;

interface DataFilterResolver
{
    /**
     * Итеративное применение фильтров.
     */
    public function resolve(): bool;
}