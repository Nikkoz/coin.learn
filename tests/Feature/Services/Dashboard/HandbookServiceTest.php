<?php

namespace Tests\Feature\Services\Dashboard;

use Throwable;
use App\Entities\Coin\Coin;
use Tests\DashboardTestCase;
use App\Entities\Coin\Handbook;
use App\Services\Dashboard\HandbookService;

class HandbookServiceTest extends DashboardTestCase
{
    private $table = 'handbooks';

    /**
     * @var HandbookService
     */
    private $service;

    /**
     * @var Coin
     */
    private $coin;

    public function setUp(): void
    {
        parent::setUp();

        $this->coin = factory(Coin::class)->create();
        $this->service = app()->make(HandbookService::class);
    }

    /**
     * @dataProvider providerCreate
     * @param array $data
     * @param bool $error
     * @throws Throwable
     */
    public function testCreate(array $data, bool $error): void
    {
        $data = array_merge($data, [
            'coin_id' => $this->coin->id,
        ]);

        if ($error) {
            $this->expectException(Throwable::class);
        }

        $this->service->create($data);

        if (!$error) {
            $this->assertDatabaseHas($this->table, $data);
        }
    }

    public function testUpdate(): void
    {
        /** @var Handbook $handbook */
        $handbook = factory(Handbook::class)->create(['title' => 'old', 'coin_id' => $this->coin->id]);

        $this->service->update($handbook->id, ['title' => 'new']);

        $this->assertDatabaseHas($this->table, ['title' => 'new']);
        $this->assertDatabaseMissing($this->table, ['title' => 'old']);
    }

    public function testDelete(): void
    {
        /** @var Handbook $handbook */
        $handbook = factory(Handbook::class)->create(['title' => 'old', 'coin_id' => $this->coin->id]);

        $this->service->delete($handbook->id);

        $this->assertDatabaseMissing($this->table, [
            'title'   => 'old',
            'coin_id' => $this->coin->id
        ]);
    }

    public function providerCreate(): array
    {
        return [
            [['title' => 'test'], false],
            [['title' => 'test2', 'field' => 'error'], true],
        ];
    }
}