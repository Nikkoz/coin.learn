<?php

namespace App\Services\Dashboard\Algorithms;

use App\Entities\Settings\Encryption;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class EncryptionService
{
    /**
     * @var EncryptionRepository
     */
    protected $repository;

    public function __construct(EncryptionRepository $repository)
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
     * Массовое удаление по ids.
     *
     * @param array $ids
     *
     * @return bool
     */
    public function massDelete(array $ids): bool
    {
        return $this->deleteModels($ids);
    }

    /**
     * Создание алгоритма шифрования.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Encryption
     */
    public function create(array $data): Encryption
    {
        $encryption = new Encryption;

        if (!$this->save($encryption, $data)) {
            throw new FailedSaveModelException(Encryption::class);
        }

        return $encryption;
    }

    /**
     * Обновление алгоритма шифрования.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws FailedSaveModelException
     * @throws Throwable
     * @return Encryption
     */
    public function update(int $id, array $data): Encryption
    {
        /** @var Encryption $coin */
        $encryption = $this->repository->getOne($id);

        if (!$this->save($encryption, $data)) {
            throw new FailedSaveModelException(Encryption::class);
        }

        return $encryption;
    }

    /**
     * Сохранение.
     *
     * @param Encryption $encryption
     * @param array      $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(Encryption $encryption, array $data): bool
    {
        $encryption->fill($data);

        return $encryption->saveOrFail();
    }

    /**
     * Удаление алгоритмов шифрования.
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
            throw new ModelNotFoundException(Encryption::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
    }
}