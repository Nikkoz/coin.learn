<?php

namespace App\Services\Dashboard;

use Log;
use Throwable;
use App\Entities\Formula;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\FormulaRepository;

class FormulaService
{
    private $repository;

    public function __construct(FormulaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Обновление настроек формулы.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Formula
     */
    public function update(int $id, array $data): Formula
    {
        /** @var Formula $formula */
        $formula = $this->repository->getById($id);

        if (!$this->save($formula, $data)) {
            throw new FailedSaveModelException(Formula::class);
        }

        return $formula;
    }

    /**
     * Сохранение.
     *
     * @param Formula $formula
     * @param array   $data
     *
     * @return bool
     */
    protected function save(Formula $formula, array $data): bool
    {
        try {
            $formula->fill($data);

            return $formula->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }
}