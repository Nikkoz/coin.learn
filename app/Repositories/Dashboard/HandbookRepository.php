<?php

namespace App\Repositories\Dashboard;

use App\Entities\Coin\Handbook;
use Illuminate\Database\Eloquent\Builder;

class HandbookRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить фразу по id.
     *
     * @param int $id
     *
     * @return Handbook
     */
    public function getOne(int $id): Handbook
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Handbook::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}