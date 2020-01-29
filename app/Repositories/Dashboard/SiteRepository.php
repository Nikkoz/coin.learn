<?php

namespace App\Repositories\Dashboard;

use App\Entities\Settings\Site;
use Illuminate\Database\Eloquent\Builder;

class SiteRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить сайт по id.
     *
     * @param int $id
     *
     * @return Site
     */
    public function getOne(int $id): Site
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Site::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}