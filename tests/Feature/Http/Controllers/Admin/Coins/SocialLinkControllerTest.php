<?php

namespace Tests\Feature\Http\Controllers\Admin\Coins;

use App\Entities\Coin\Coin;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Tests\DashboardTestCase;

class SocialLinkControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->get(route('admin.links.index', $coin->id));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->get(route('admin.links.create', $coin->id));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     * @param string $link
     * @param bool $isError
     */
    public function testStore(string $link, bool $isError): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        $response = $this->post(route('admin.links.store', $coin->id), [
            'link'       => $link,
            'network_id' => $network->id,
            'coin_id'    => $coin->id
        ]);
        $response->assertStatus(302);

        if ($isError) {
            $response->assertSessionHas('errors');
        } else {
            $this->assertDatabaseHas('social_links', [
                'link'       => $link,
                'network_id' => $network->id,
                'coin_id'    => $coin->id
            ]);
        }
    }

    public function testEdit(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create();

        $response = $this->get(route('admin.coins.edit', ['coinId' => $coin->id, 'id' => $link->id]));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        factory(SocialNetwork::class, 2)->create();

        /** @var SocialNetwork[] $networks */
        $networks = SocialNetwork::all();

        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create([
            'coin_id'    => $coin->id,
            'network_id' => $networks[0]->id
        ]);

        $response = $this->put(route('admin.links.update', ['coinId' => $coin->id, 'id' => $link->id]), [
            'link'       => 'new',
            'network_id' => $networks[1]->id,
            'coin_id'    => $coin->id
        ]);
        $response->assertStatus(302);

        $link->refresh();

        $this->assertDatabaseHas('social_links', [
            'id'         => $link->id,
            'link'       => $link->link,
            'network_id' => $networks[1]->id,
        ]);
    }

    public function testDelete(): void
    {
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create();

        $response = $this->delete(route('admin.links.destroy', ['coinId' => $coin->id, 'id' => $link->id]));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('social_links', [
            'id' => $link->id
        ]);
    }

    public function providerStore(): array
    {
        return [
            ['test', false], // сохраниться
            ['', true], // не сохраниться, ошибка валидации, обязательное поле
        ];
    }
}