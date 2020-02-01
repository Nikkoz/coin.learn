<?php

namespace App\Services\Dashboard;

use Log;
use Exception;
use Throwable;
use App\Entities\Settings\Exchange;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\ExchangeRepository;

class ExchangeService
{
    private $repository;

    public function __construct(ExchangeRepository $repository)
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
     * Создание биржы.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @return Exchange
     */
    public function create(array $data): Exchange
    {
        $exchange = new Exchange;

        if (!$this->save($exchange, $data)) {
            throw new FailedSaveModelException(Exchange::class);
        }

        return $exchange;
    }

    /**
     * Обновление сайта.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Exchange
     */
    public function update(int $id, array $data): Exchange
    {
        /** @var Exchange $exchange */
        $exchange = $this->repository->getOne($id);

        if (!$this->save($exchange, $data)) {
            throw new FailedSaveModelException(Exchange::class);
        }

        return $exchange;
    }

    /**
     * Сохранение.
     *
     * @param Exchange $exchange
     * @param array    $data
     *
     * @return bool
     */
    public function save(Exchange $exchange, array $data): bool
    {
        try {
            $exchange->fill($data);

            return $exchange->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }

    public function getCount(): int
    {
        return $this->repository->queryBuilder()->count();
    }
}