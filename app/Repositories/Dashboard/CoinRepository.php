<?php

namespace App\Repositories\Dashboard;

use App\Entities\Coin\Coin;
use Illuminate\Database\Eloquent\Builder;

class CoinRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить монету по id.
     *
     * @param int $id
     *
     * @return Coin
     */
    public function getOne(int $id): Coin
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Coin::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}