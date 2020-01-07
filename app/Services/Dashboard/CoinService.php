<?php

namespace App\Services\Dashboard;

use App\Entities\Coin\Coin;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\CoinRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class CoinService
{
    /**
     * @var CoinRepository
     */
    protected $repository;

    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(CoinRepository $repository, ImageService $imageService)
    {
        $this->repository = $repository;
        $this->imageService = $imageService;
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
     * @param Coin  $coin
     * @param array $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(Coin $coin, array $data): bool
    {
        return DB::transaction(function () use ($coin, $data) {
            $coin->fill($data);

            if (!empty($data['image'])) {
                $image = $this->imageService->create([
                    'file' => $data['image'],
                    'path' => Coin::PATH
                ]);

                $coin->image = $image->id;
            }


            return $coin->saveOrFail();
        });
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
