<?php

namespace App\Services\Dashboard\Algorithms;

use Log;
use Exception;
use Throwable;
use App\Entities\Settings\Consensus;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;

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

        return $model->delete() === true;
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
     * @return bool
     */
    protected function save(Consensus $consensus, array $data): bool
    {
        try {
            $consensus->fill($data);

            return $consensus->saveOrFail();
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