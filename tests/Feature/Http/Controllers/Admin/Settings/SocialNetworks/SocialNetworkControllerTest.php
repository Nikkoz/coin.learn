<?php

namespace Tests\Feature\Http\Controllers\Admin\Settings\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Tests\DashboardTestCase;

class SocialNetworkControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        $response = $this->get(route('admin.settings.social.networks.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('admin.settings.social.networks.create'));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     * @param array $params
     * @param bool $isError
     */
    public function testStore(array $params, bool $isError): void
    {
        $response = $this->post(route('admin.settings.social.networks.store'), $params);
        $response->assertStatus(302);

        if ($isError) {
            $response->assertSessionHas('errors');
        } else {
            $this->assertDatabaseHas('social_networks', $params);
        }
    }

    public function testEdit(): void
    {
        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        $response = $this->get(route('admin.settings.social.networks.edit', $network->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        $response = $this->put(route('admin.settings.social.networks.update', $network->id), [
            'name' => 'new',
            'link' => 'newLink'
        ]);
        $response->assertStatus(302);

        $network->refresh();

        $this->assertDatabaseHas('social_networks', [
            'id'   => $network->id,
            'name' => $network->name,
            'link' => $network->link,
        ]);
    }

    public function testDelete(): void
    {
        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create();

        $response = $this->delete(route('admin.settings.social.networks.destroy', $network->id));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('social_networks', [
            'id' => $network->id
        ]);
    }

    public function providerStore(): array
    {
        return [
            [['name' => 'test', 'link' => 'testlink'], false], // сохраниться
            [['name' => ''], true], // не сохранится, ошибка валидации, обязательное поле
        ];
    }
}