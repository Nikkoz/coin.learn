<?php

namespace App\Services\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\SocialNetworks\SocialLinkRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class SocialLinkService
{
    private $repository;

    public function __construct(SocialLinkRepository $repository)
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
     * Создание ссылки.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return SocialLink
     */
    public function create(array $data): SocialLink
    {
        $link = new SocialLink;

        if (!$this->save($link, $data)) {
            throw new FailedSaveModelException(SocialLink::class);
        }

        return $link;
    }

    /**
     * Обновление ссылки.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return SocialLink
     */
    public function update(int $id, array $data): SocialLink
    {
        /** @var SocialLink $link */
        $link = $this->repository->getOne($id);

        if (!$this->save($link, $data)) {
            throw new FailedSaveModelException(SocialLink::class);
        }

        return $link;
    }

    /**
     * Сохранение.
     *
     * @param SocialLink $link
     * @param array      $data
     *
     * @throws Exception
     * @throws Throwable
     * @return bool
     */
    protected function save(SocialLink $link, array $data): bool
    {
        $link->fill($data);

        return $link->saveOrFail();
    }

    /**
     * Удаление ссылок.
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
            throw new ModelNotFoundException(SocialLink::class . ' with id=' . implode(', ', $ids) . ' not found.');
        }

        return $delete;
    }
}