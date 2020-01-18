<?php

namespace App\Services\Dashboard;

use App\Entities\Coin\Handbook;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\HandbookRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class HandbookService
{
    private $repository;

    public function __construct(HandbookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Удаление по id.
     *
     * @param int $id
     *
     * @throws Exception
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->repository->getOne($id);

        return !($model->delete() !== true);
    }

    /**
     * Создание фразы.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Handbook
     */
    public function create(array $data): Handbook
    {
        $handbook = new Handbook;

        if (!$this->save($handbook, $data)) {
            throw new FailedSaveModelException(Handbook::class);
        }

        return $handbook;
    }

    /**
     * Обновление фразы.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Handbook
     */
    public function update(int $id, array $data): Handbook
    {
        /** @var Handbook $handbook */
        $handbook = $this->repository->getOne($id);

        if (!$this->save($handbook, $data)) {
            throw new FailedSaveModelException(Handbook::class);
        }

        return $handbook;
    }

    /**
     * Сохранение.
     *
     * @param Handbook $link
     * @param array    $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(Handbook $link, array $data): bool
    {
        $link->fill($data);

        return $link->saveOrFail();
    }

    /**
     * Удаление фраз.
     *
     * @param array $ids
     *
     * @throws ModelNotFoundException
     * @return bool
     */
    protected function deleteModels(array $ids): bool
    {
        $delete = $this->repository->queryBuilder()->whereIn('id', $ids)->delete();

        if ($delete === null) {
            throw new ModelNotFoundException(Handbook::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
    }
}