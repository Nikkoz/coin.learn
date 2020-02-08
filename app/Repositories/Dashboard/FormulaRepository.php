<?php

namespace App\Repositories\Dashboard;

use App\Entities\Formula;
use Illuminate\Database\Eloquent\Builder;

class FormulaRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Formula::query();
    }

    public function get(): Formula
    {
        return $this->queryBuilder()->first();
    }

    /**
     * Получить формулу по id.
     *
     * @param int $id
     *
     * @return Formula
     */
    public function getById(int $id): Formula
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return 0;
    }
}