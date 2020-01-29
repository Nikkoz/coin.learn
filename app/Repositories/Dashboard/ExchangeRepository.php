<?php

namespace App\Repositories\Dashboard;

use App\Entities\Settings\Exchange;
use Illuminate\Database\Eloquent\Builder;

class ExchangeRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить биржу по id.
     *
     * @param int $id
     *
     * @return Exchange
     */
    public function getOne(int $id): Exchange
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Exchange::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}