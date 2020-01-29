<?php

namespace Tests\Feature\Services\Dashboard;

use App\Dictionaries\Coins\CoinTypeDictionary;
use App\Entities\Coin\Coin;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Managers\Dashboard\FileManager;
use App\Repositories\Dashboard\CoinRepository;
use App\Services\Dashboard\CoinService;
use App\Services\Dashboard\ImageService;
use Illuminate\Http\UploadedFile;
use Mockery;
use Tests\DashboardTestCase;

class CoinServiceTest extends DashboardTestCase
{
    private $table       = 'coins';
    private $linksTable  = 'social_links';
    private $imagesTable = 'images';

    /**
     * @var CoinService
     */
    private $service;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $fileManager = Mockery::mock(FileManager::class);
        $fileManager->shouldReceive('save')
            ->andReturn('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'example.jpg');
        $fileManager->shouldReceive('remove')->andReturn(true);

        $imageService = new ImageService($fileManager);
        $this->service = new CoinService(new CoinRepository, $imageService);
    }

    public function testCreate(): void
    {
        $image = UploadedFile::fake()->image('example.jpg');

        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        $coin = $this->service->create([
            'name'     => 'TestCoin',
            'code'     => 'TC',
            'type'     => CoinTypeDictionary::TYPE_COIN,
            'image_id' => $image,
        ]);

        $this->assertDatabaseHas($this->table, [
            'id'   => $coin->id,
            'name' => 'TestCoin',
            'code' => 'TC',
        ]);

        $this->assertDatabaseHas($this->imagesTable, [
            'id' => $coin->image_id
        ]);
    }

    public function testUpdate(): void
    {
        $image = UploadedFile::fake()->image('example.jpg');

        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        /** @var Coin $coin */
        $coin = factory(Coin::class)->create([
            'name' => 'TestCoin',
            'code' => 'TC',
            'type' => CoinTypeDictionary::TYPE_COIN,
        ]);

        $this->service->update($coin->id, [
            'name'     => 'TestCoinNew',
            'type'     => CoinTypeDictionary::TYPE_TOKEN,
            'image_id' => $image,
        ]);

        $this->assertDatabaseHas($this->table, [
            'name' => 'TestCoinNew',
            'type' => CoinTypeDictionary::TYPE_TOKEN,
        ]);

        $this->assertDatabaseMissing($this->table, [
            'name' => 'TestCoin',
            'type' => CoinTypeDictionary::TYPE_COIN,
        ]);

        $this->assertDatabaseHas($this->imagesTable, [
            'id' => $coin->image_id
        ]);
    }

    public function testDelete(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create([
            'name' => 'TestCoin',
            'code' => 'TC',
            'type' => CoinTypeDictionary::TYPE_COIN,
        ]);

        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create([
            'coin_id' => $coin->id
        ]);

        $this->service->delete($coin->id);

        $this->assertDatabaseMissing($this->table, [
            'id' => $coin->id
        ]);
    }
}