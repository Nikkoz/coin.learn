<?php

namespace App\Services\Dashboard;

use App\Dictionaries\Coins\CoinStatusDictionary;
use App\Entities\Coin\Coin;
use App\Exceptions\FailedSaveModelException;
use App\Manager\Dashboard\FileManager;
use App\Repositories\Dashboard\CoinRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class CoinService
{
    /**
     * @var CoinRepository
     */
    protected $repository;

    /**
     * @var FileManager
     */
    protected $manager;

    public function __construct(CoinRepository $repository, FileManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
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
     * Создание монеты.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Coin
     */
    public function create(array $data): Coin
    {
        $coin = new Coin;
        $data['status'] = CoinStatusDictionary::ACTIVE;

        if (!$this->save($coin, $data)) {
            throw new FailedSaveModelException(Coin::class);
        }

        return $coin;
    }

    /**
     * Обновление монеты.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Coin
     */
    public function update(int $id, array $data): Coin
    {
        /** @var Coin $coin */
        $coin = $this->repository->getOne($id);

        if (!$this->save($coin, $data)) {
            throw new FailedSaveModelException(Coin::class);
        }

        return $coin;
    }

    /**
     * Сохранение.
     *
     * @param Coin  $film
     * @param array $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(Coin $film, array $data): bool
    {
        return true;
    }

    /**
     * Удаление монет.
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
            throw new ModelNotFoundException(Coin::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
    }
}
