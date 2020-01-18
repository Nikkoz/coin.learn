<?php

namespace App\Services\Dashboard;

use App\Entities\Coin\Coin;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\CoinRepository;
use App\Services\Dashboard\SocialNetworks\SocialLinkService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @var SocialLinkService
     */
    private $socialLinkService;

    public function __construct(CoinRepository $repository, ImageService $imageService, SocialLinkService $socialLinkService)
    {
        $this->repository = $repository;
        $this->imageService = $imageService;
        $this->socialLinkService = $socialLinkService;
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
            if (isset($data['socials'])) {
                $socials = $data['socials'];
                unset($data['socials']);
            }

            if (isset($data['newSocials'])) {
                $newSocials = $data['newSocials'];
                unset($data['newSocials']);
            }

            $coin->fill($data);

            if (!empty($data['image_id'])) {
                $image = $this->imageService->create([
                    'file' => $data['image_id'],
                    'path' => Coin::PATH
                ]);

                $coin->image_id = $image->id;
            }

            if (!empty($socials)) {
                foreach ($socials as $sid => $social) {
                    $this->socialLinkService->update($sid, $socials[$sid] + ['coin_id' => $coin->id]);
                }
            }

            $result = $coin->saveOrFail();

            if (!empty($newSocials) && $result) {
                foreach ($newSocials as $social) {
                    $this->socialLinkService->create($social + ['coin_id' => $coin->id]);
                }
            }

            return $result;
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

    /**
     * Получить массив монет для формирования селектора.
     *
     * @return array
     */
    public function getAllForSelector(): array
    {
        /** @var Collection $collection */
        $collection = $this->repository->getAll([], 'name', 'asc');

        return $collection->mapWithKeys(
            static function ($item) {
                return [$item['id'] => $item['name']];
            })->all();
    }
}
