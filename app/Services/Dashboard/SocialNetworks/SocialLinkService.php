<?php

namespace App\Services\Dashboard\SocialNetworks;

use Log;
use Exception;
use Throwable;
use App\Exceptions\FailedSaveModelException;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Repositories\Dashboard\SocialNetworks\SocialLinkRepository;

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

        return $model->delete() === true;
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
     * @return bool
     */
    protected function save(SocialLink $link, array $data): bool
    {
        try {
            $link->fill($data);

            return $link->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }
}