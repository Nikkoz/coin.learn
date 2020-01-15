<?php

namespace App\Services\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class SocialNetworkService
{
    private $repository;

    public function __construct(SocialNetworkRepository $repository)
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
     * Создание соц. сети.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return SocialNetwork
     */
    public function create(array $data): SocialNetwork
    {
        $network = new SocialNetwork;

        if (!$this->save($network, $data)) {
            throw new FailedSaveModelException(SocialNetwork::class);
        }

        return $network;
    }

    /**
     * Обновление соц. сети.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return SocialNetwork
     */
    public function update(int $id, array $data): SocialNetwork
    {
        /** @var SocialNetwork $network */
        $network = $this->repository->getOne($id);

        if (!$this->save($network, $data)) {
            throw new FailedSaveModelException(SocialNetwork::class);
        }

        return $network;
    }

    /**
     * Сохранение.
     *
     * @param SocialNetwork $network
     * @param array         $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(SocialNetwork $network, array $data): bool
    {
        $network->fill($data);

        return $network->saveOrFail();
    }

    /**
     * Удаление соц. сетей.
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
            throw new ModelNotFoundException(SocialNetwork::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
    }

    /**
     * Получить массив соц. сетей для формирования селектора.
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