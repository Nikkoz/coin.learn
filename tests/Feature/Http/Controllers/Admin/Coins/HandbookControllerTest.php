<?php

namespace Tests\Feature\Http\Controllers\Admin\Coins;

use App\Entities\Coin\Coin;
use App\Entities\Coin\Handbook;
use Tests\DashboardTestCase;

class HandbookControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->get(route('admin.coins.handbooks.index', $coin->id));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->get(route('admin.coins.handbooks.create', $coin->id));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     * @param string $title
     * @param bool $isError
     */
    public function testStore(string $title, bool $isError): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->post(route('admin.coins.handbooks.store', $coin->id), [
            'title'   => $title,
            'coin_id' => $coin->id
        ]);
        $response->assertStatus(302);

        if ($isError) {
            $response->assertSessionHas('errors');
        } else {
            $this->assertDatabaseHas('handbooks', [
                'title'   => $title,
                'coin_id' => $coin->id
            ]);
        }
    }

    public function testEdit(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var Handbook $handbook */
        $handbook = factory(Handbook::class)->create();

        $response = $this->get(route('admin.coins.handbooks.edit', ['coinId' => $coin->id, 'id' => $handbook->id]));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var Handbook $handbook */
        $handbook = factory(Handbook::class)->create([
            'coin_id' => $coin->id,
            'title'   => 'test'
        ]);

        $response = $this->put(route('admin.coins.handbooks.update', ['coinId' => $coin->id, 'id' => $handbook->id]), [
            'title'   => 'new',
            'coin_id' => $coin->id
        ]);
        $response->assertStatus(302);

        $handbook->refresh();

        $this->assertDatabaseHas('handbooks', [
            'id'      => $handbook->id,
            'coin_id' => $handbook->coin_id,
            'title'   => 'new'
        ]);
    }

    public function testDelete(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var Handbook $handbook */
        $handbook = factory(Handbook::class)->create();

        $response = $this->delete(route('admin.coins.handbooks.destroy', ['coinId' => $coin->id, 'id' => $handbook->id]));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('handbooks', [
            'id' => $handbook->id
        ]);
    }

    public function providerStore(): array
    {
        return [
            ['test', false], // сохраниться
            ['', true], // не сохранится, ошибка валидации, обязательное поле
        ];
    }
}