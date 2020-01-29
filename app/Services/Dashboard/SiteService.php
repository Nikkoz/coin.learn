<?php

namespace App\Services\Dashboard;

use Exception;
use Throwable;
use App\Entities\Settings\Site;
use App\Exceptions\FailedSaveModelException;
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
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $model = $this->repository->getOne($id);

        return !($model->delete() !== true);
    }

    /**
     * Создание сайта.
     *
     * @param array $data - post данные
     *
     * @return Site
     * @throws Throwable
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
     * @param int $id
     * @param array $data
     *
     * @return Site
     * @throws Throwable
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
     * @param Site $site
     * @param array $data
     *
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function save(Site $site, array $data): bool
    {
        $site->fill($data);

        return $site->saveOrFail();
    }

    public function getCount(): int
    {
        return $this->repository->queryBuilder()->count();
    }
}