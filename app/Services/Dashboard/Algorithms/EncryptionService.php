<?php

namespace App\Services\Dashboard\Algorithms;

use Log;
use Exception;
use Throwable;
use App\Entities\Settings\Encryption;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;

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
     * @return bool
     */
    protected function save(Encryption $encryption, array $data): bool
    {
        try {
            $encryption->fill($data);

            return $encryption->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }

    /**
     * Получить массив алгоримов для формирования селектора.
     *
     * @return array
     */
    public function getAllForSelector(): array
    {
        /** @var Collection $collection */
        $collection = $this->repository->getAll([], 'name', 'asc');

        return $collection->mapWithKeys(static function ($item) {
            return [$item['id'] => $item['name']];
        })->all();
    }
}