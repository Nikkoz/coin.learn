<?php

namespace App\Console\Commands\Coin;

use App\Entities\Coin\Coin;
use App\Console\BaseCommand;
use App\Managers\CoinMarketManager;
use App\Dictionaries\StatusDictionary;
use App\Services\Dashboard\CoinService;
use App\Repositories\Dashboard\SocialNetworks\SocialLinkRepository;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;

class ImportCommand extends BaseCommand
{
    protected $signature   = 'coin:import {--all}';

    protected $description = 'Import coins from market';

    private   $service;

    private   $manager;

    private   $linkRepository;

    private   $networkRepository;

    public function __construct(
        CoinService $service,
        CoinMarketManager $manager,
        SocialLinkRepository $linkRepository,
        SocialNetworkRepository $networkRepository
    )
    {
        parent::__construct();

        $this->service = $service;
        $this->manager = $manager;
        $this->linkRepository = $linkRepository;
        $this->networkRepository = $networkRepository;
    }

    public function handle(): int
    {
        $this->info('Start import coins ...' . "\n");

        $all = (bool)$this->option('all');

        $coins = $this->manager->import($all);

        if (!$coins->count()) {
            $this->info('No coins to import!');

            return static::OK;
        }

        $networks = $this->networkRepository->getAll([
            'status' => StatusDictionary::ACTIVE,
        ])->pluck('id', 'name');

        $bar = $this->output->createProgressBar($coins->count());
        $bar->start();

        $coins->each(function (array $coin) use ($bar, $networks) {
            /** @var Coin $model */
            $model = Coin::firstOrNew(['market_id' => $coin['market_id']]);

            $socials = $this->checkLinks($coin);

            $this->service->save($model, array_merge($coin, [
                'status' => StatusDictionary::ACTIVE,
            ]));

            $this->service->setLinks($model, $networks, $socials);
            $this->service->setHandbooks($model, [$model->name, $model->code]);

            $bar->advance();
        });

        $bar->finish();

        $this->info("\n" . 'Coins were imported.');

        return static::OK;
    }

    protected function checkLinks(array &$coin): array
    {
        $socials = [];

        if (array_key_exists('twitter', $coin)) {
            $socials['twitter'] = $coin['twitter'];
            unset($coin['twitter']);
        }

        if (array_key_exists('reddit', $coin)) {
            $socials['reddit'] = $coin['reddit'];
            unset($coin['reddit']);
        }

        if (array_key_exists('facebook', $coin)) {
            $socials['facebook'] = $coin['facebook'];
            unset($coin['facebook']);
        }

        return $socials;
    }
}
