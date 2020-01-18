<?php

namespace App\Repositories\Dashboard\Algorithms;

use App\Entities\Settings\Consensus;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class ConsensusRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить алгоритм консенсуса по id.
     *
     * @param int $id
     *
     * @return Consensus
     */
    public function getOne(int $id): Consensus
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Consensus::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}