<?php

namespace App\Managers;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use App\Contracts\Services\Coins\CoinMarket;
use App\Repositories\Dashboard\CoinRepository;
use App\Dictionaries\Coins\CoinTypeDictionary;

class CoinMarketManager
{
    public const CHUNK      = 300;
    public const TYPE_COIN  = 'coin';
    public const TYPE_TOKEN = 'token';

    private $market;

    private $repository;

    public function __construct(CoinMarket $market, CoinRepository $repository)
    {
        $this->market = $market;
        $this->repository = $repository;
    }

    public function import(bool $all = false): Collection
    {
        $mapCoins = $this->market->map();

        if (!$all) {
            $mapCoins = $this->trimCoins($mapCoins);
        }

        $result = [];

        $mapCoins->unique('code')->chunk(self::CHUNK)->each(function (Collection $collection, int $key) use (&$result) {
            $start = $key * self::CHUNK + 1;

            $latestCoins = $this->market->latest([
                'start' => $start,
                'limit' => self::CHUNK,
                'aux'   => 'max_supply',
            ])->keyBy('id');
            $metaCoins = $this->market->info(['id' => $latestCoins->implode('id', ',')]);

            $collection->each(function (array $item) use (&$result, $latestCoins, $metaCoins) {
                $meta = $metaCoins->has($item['id']) ? $metaCoins[$item['id']] : $item;
                $latest = $latestCoins->has($item['id']) ? $latestCoins[$item['id']] : $item;

                $coin = [
                    'market_id'    => $item['id'],
                    'name'         => $meta['name'],
                    'code'         => $meta['symbol'],
                    'alias'        => $meta['slug'],
                    'type'         => isset($meta['category']) && $meta['category'] === self::TYPE_TOKEN ?
                        CoinTypeDictionary::TYPE_TOKEN : CoinTypeDictionary::TYPE_COIN,
                    'date_start'   => isset($meta['date_added']) ? Carbon::parse($meta['date_added'])
                        ->format('Y-m-d') : null,
                    'max_supply'   => $latest['max_supply'] ?? null,
                    'key_features' => $meta['description'] ?? '',
                    'image_id'     => isset($meta['logo']) ? $this->uploadImage($meta['logo']) : null,
                ];

                if (isset($meta['urls'])) {
                    $coin += [
                        'site'     => $meta['urls']['website'][0] ?? '',
                        'links'    => $meta['urls']['explorer'],
                        'chat'     => $meta['urls']['chat'][0] ?? '',
                        'twitter'  => $meta['urls']['twitter'][0] ?? '',
                        'reddit'   => $meta['urls']['reddit'][0] ?? '',
                        'facebook' => $meta['urls']['facebook'][0] ?? '',
                    ];
                }

                $result[] = $coin;
            });
        });

        return collect($result);
    }

    /**
     * Удаляет из коллекции уже существующие монеты
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    protected function trimCoins(Collection $collection): Collection
    {
        $coins = $this->repository->getAll(['uploaded' => false])->pluck('market_id');

        return $collection->filter(static function ($coin) use ($coins) {
            return !$coins->contains($coin['id']);
        });
    }

    protected function uploadImage(string $url): UploadedFile
    {
        $info = pathinfo($url);
        $contents = file_get_contents($url);

        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);

        return new UploadedFile($file, $info['basename']);
    }
}