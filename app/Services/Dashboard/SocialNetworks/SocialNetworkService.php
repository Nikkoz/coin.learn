<?php

namespace App\Services\Dashboard\SocialNetworks;

use Log;
use Exception;
use Throwable;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\FailedSaveModelException;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;

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
     * @return bool
     */
    protected function save(SocialNetwork $network, array $data): bool
    {
        try {
            $network->fill($data);

            return $network->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }

    /**
     * Получить массив соц. сетей для формирования селектора.
     *
     * @return array
     */
    public function getAllForSelector(): array
    {
        /** @var Collection $collection */
        $collection = $this->repository->getAll(['status' => StatusDictionary::ACTIVE], 'name', 'asc');

        return $collection->mapWithKeys(static function ($item) {
            return [$item['id'] => $item['name']];
        })->all();
    }
}