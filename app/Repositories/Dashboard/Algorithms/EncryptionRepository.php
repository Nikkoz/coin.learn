<?php

namespace App\Repositories\Dashboard\Algorithms;

use App\Entities\Settings\Encryption;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class EncryptionRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить алгоритм шифрования по id.
     *
     * @param int $id
     *
     * @return Encryption
     */
    public function getOne(int $id): Encryption
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Encryption::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}