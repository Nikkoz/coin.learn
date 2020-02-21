<?php

namespace App\Services\Dashboard;

use Exception;
use Throwable;
use App\Entities\Coin\Coin;
use Illuminate\Support\Str;
use App\Entities\Coin\Handbook;
use Illuminate\Support\Facades\DB;
use App\Dictionaries\StatusDictionary;
use App\Exceptions\FailedSaveModelException;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Dashboard\CoinRepository;
use App\Entities\Settings\SocialNetworks\SocialLink;

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

        return $model->delete() === true;
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
        $coin = new Coin();

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
    public function save(Coin $coin, array $data): bool
    {
        return DB::transaction(function () use ($coin, $data) {
            $coin->fill($data);

            if (!empty($data['image_id'])) {
                $image = $this->imageService->create([
                    'file' => $data['image_id'],
                    'path' => Coin::PATH,
                ]);

                $coin->image_id = $image->id;
            }

            return $coin->saveOrFail();
        });
    }

    public function setLinks(Coin $coin, \Illuminate\Support\Collection $networks, array $links = []): void
    {
        $socialLinks = [];

        foreach ($links as $type => $link) {
            $type = Str::title($type);

            if (!$link) {
                continue;
            }

            $socialLinks[] = SocialLink::firstOrNew([
                'coin_id'    => $coin->id,
                'link'       => $link,
                'network_id' => $networks->has($type) ? $networks->get($type) : 0,
            ]);
        }

        $coin->socialLinks()->saveMany($socialLinks);
    }

    public function setHandbooks(Coin $coin, array $handbooks): void
    {
        $coinHandbooks = [];

        foreach ($handbooks as $word) {
            $coinHandbooks[] = Handbook::firstOrNew([
                'title'   => $word,
                'coin_id' => $coin->id,
                'status'  => 1,
            ]);
        }

        $coin->handbooks()->saveMany($coinHandbooks);
    }

    /**
     * Получить массив монет для формирования селектора.
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

    /**
     * Общее кол-во монет
     */
    public function getCount(): int
    {
        return $this->repository->queryBuilder()->count();
    }
}
