<?php

namespace App\Services\Dashboard;

use Log;
use Exception;
use Throwable;
use App\Entities\Settings\Site;
use App\Dictionaries\StatusDictionary;
use App\Exceptions\FailedSaveModelException;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Dashboard\SiteRepository;

class SiteService
{
    private $repository;

    public function __construct(SiteRepository $repository)
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
     * Создание сайта.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Site
     */
    public function create(array $data): Site
    {
        $site = new Site;

        if (!$this->save($site, $data)) {
            throw new FailedSaveModelException(Site::class);
        }

        return $site;
    }

    /**
     * Обновление сайта.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Site
     */
    public function update(int $id, array $data): Site
    {
        /** @var Site $site */
        $site = $this->repository->getOne($id);

        if (!$this->save($site, $data)) {
            throw new FailedSaveModelException(Site::class);
        }

        return $site;
    }

    /**
     * Сохранение.
     *
     * @param Site  $site
     * @param array $data
     *
     * @return bool
     */
    public function save(Site $site, array $data): bool
    {
        try {
            $site->fill($data);

            return $site->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }

    public function getCount(): int
    {
        return $this->repository->queryBuilder()->count();
    }

    /**
     * Получить массив сайтов для формирования селектора.
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