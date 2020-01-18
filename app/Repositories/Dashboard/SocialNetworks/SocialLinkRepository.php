<?php

namespace App\Repositories\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class SocialLinkRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить ссылку по id.
     *
     * @param int $id
     *
     * @return SocialLink
     */
    public function getOne(int $id): SocialLink
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return SocialLink::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}