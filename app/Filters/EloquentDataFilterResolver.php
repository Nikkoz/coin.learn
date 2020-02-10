<?php

namespace App\Filters;

use App\Contracts\Filters\DataFilterable;
use App\Contracts\Filters\DataFilterResolver;

class EloquentDataFilterResolver implements DataFilterResolver
{
    /**
     *  Фильтры.
     *
     * @var callable[]
     */
    protected $filters = [];

    public function __construct(DataFilterable $model)
    {
        $this->prepareFilters($model->getDataFilterConfig());
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(): bool
    {
        foreach ($this->filters as $filter) {
            $filter();
        }

        return true;
    }

    /**
     * Формируем пулл фильтров.
     *
     * @param array $getFilterConfig
     */
    protected function prepareFilters(array $getFilterConfig): void
    {
        foreach ($getFilterConfig as $config) {
            if ($config['condition']()) {
                $this->filters[] = $config['filter'];
            }
        }
    }
}