<?php

namespace App\Services\Dashboard\Algorithms;

use App\Entities\Settings\Consensus;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class ConsensusService
{
    /**
     * @var ConsensusRepository
     */
    protected $repository;

    public function __construct(ConsensusRepository $repository)
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
     * Создание алгоритма консенсуса.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Consensus
     */
    public function create(array $data): Consensus
    {
        $consensus = new Consensus;

        if (!$this->save($consensus, $data)) {
            throw new FailedSaveModelException(Consensus::class);
        }

        return $consensus;
    }

    /**
     * Обновление алгоритма консенсуса.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws FailedSaveModelException
     * @throws Throwable
     * @return Consensus
     */
    public function update(int $id, array $data): Consensus
    {
        /** @var Consensus $coin */
        $consensus = $this->repository->getOne($id);

        if (!$this->save($consensus, $data)) {
            throw new FailedSaveModelException(Consensus::class);
        }

        return $consensus;
    }

    /**
     * Сохранение.
     *
     * @param Consensus $consensus
     * @param array     $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(Consensus $consensus, array $data): bool
    {
        $consensus->fill($data);

        return $consensus->saveOrFail();
    }

    /**
     * Удаление алгоритмов консенсуса.
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
            throw new ModelNotFoundException(Consensus::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
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