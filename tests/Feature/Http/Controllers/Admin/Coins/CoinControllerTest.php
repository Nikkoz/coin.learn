<?php

namespace Tests\Feature\Http\Controllers\Admin\Coins;

use App\Entities\Image;
use App\Entities\Coin\Coin;
use Tests\DashboardTestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Managers\Dashboard\FileManager;
use App\Dictionaries\Coins\CoinTypeDictionary;

class CoinControllerTest extends DashboardTestCase
{
    protected $manager;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->manager = new FileManager;
    }

    public function testIndex(): void
    {
        $response = $this->get(route('admin.coins.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('admin.coins.create'));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     * @param array $params
     * @param string $session
     * @param bool $isError
     */
    public function testStore(array $params, string $session, bool $isError): void
    {
        if ($isError) {
            factory(Coin::class)->create($params);
        }

        $response = $this->post(route('admin.coins.store'), $params);
        $response->assertStatus(302);

        if ($session) {
            $response->assertSessionHas($session);
        }

        if (!$isError) {
            $this->assertDatabaseHas('coins', [
                'name' => 'test',
                'code' => 'TST',
                'type' => CoinTypeDictionary::TYPE_COIN,
            ]);
        }
    }

    public function testEdit(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->get(route('admin.coins.edit', $coin->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create([
            'type' => CoinTypeDictionary::TYPE_COIN
        ]);

        $image = UploadedFile::fake()->image('example.png');

        $response = $this->put(route('admin.coins.update', $coin->id), [
            'type'     => CoinTypeDictionary::TYPE_TOKEN,
            'image_id' => $image,
        ]);
        $response->assertStatus(302);

        $coin->refresh();

        Storage::disk('public')->assertMissing($coin->image->path);

        $this->assertDatabaseHas('coins', [
            'name'     => $coin->name,
            'type'     => $coin->type,
            'image_id' => $coin->image_id,
        ]);

        $this->assertDatabaseHas('images', [
            'id' => $coin->image_id,
        ]);
    }

    public function testDelete(): void
    {
        $path = $this->manager->save(UploadedFile::fake()->image('example.png'), Coin::PATH);

        /** @var Image $image */
        $image = factory(Image::class)->create([
            'path' => $path
        ]);

        /** @var Coin $coin */
        $coin = factory(Coin::class)->create([
            'image_id' => $image->id
        ]);

        $response = $this->delete(route('admin.coins.destroy', $coin->id));
        $response->assertStatus(302);

        Storage::disk('public')->assertMissing($coin->image->path);

        $this->assertDatabaseMissing('coins', [
            'id' => $coin->id
        ]);
        $this->assertDatabaseMissing('images', [
            'id' => $image->id
        ]);
    }

    public function providerStore(): array
    {
        return [
            [['name' => 'test', 'code' => 'TST', 'type' => CoinTypeDictionary::TYPE_COIN], '', false], // монета сохраниться
            [[], 'errors', true], // монета не сохраниться, ошибки валидации
            [['name' => 'test', 'code' => 'TST', 'type' => CoinTypeDictionary::TYPE_COIN], 'errors', true], // не сохраниться, ошибки валидации уникальных полей
        ];
    }
}