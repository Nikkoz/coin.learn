<?php

namespace Tests\Feature\Services\Dashboard\SocialNetworks;

use Exception;
use Throwable;
use App\Entities\Coin\Coin;
use Tests\DashboardTestCase;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Services\Dashboard\SocialNetworks\SocialLinkService;

class SocialLinkServiceTest extends DashboardTestCase
{
    private $table = 'social_links';

    /**
     * @var Coin
     */
    private $coin;

    /**
     * @var SocialNetwork
     */
    private $network;

    /**
     * @var SocialLinkService
     */
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->coin = factory(Coin::class)->create();
        $this->network = factory(SocialNetwork::class)->create();
        $this->service = app()->make(SocialLinkService::class);
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $data
     * @param bool  $error
     *
     * @throws Throwable
     */
    public function testCreate(array $data, bool $error): void
    {
        $data = array_merge($data, [
            'coin_id'    => $this->coin->id,
            'network_id' => $this->network->id,
        ]);

        if ($error) {
            $this->expectException(Throwable::class);
        }

        $this->service->create($data);

        if (!$error) {
            $this->assertDatabaseHas($this->table, $data);
        }
    }

    /**
     * @throws Throwable
     */
    public function testUpdate(): void
    {
        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create([
            'link'       => 'test',
            'coin_id'    => $this->coin->id,
            'network_id' => $this->network->id,
        ]);

        $this->service->update($link->id, ['link' => 'test_new']);

        $this->assertDatabaseHas($this->table, ['link' => 'test_new']);
        $this->assertDatabaseMissing($this->table, ['link' => 'test']);
    }

    /**
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var SocialLink $link */
        $link = factory(SocialLink::class)->create([
            'link'       => 'test',
            'coin_id'    => $this->coin->id,
            'network_id' => $this->network->id,
        ]);

        $this->service->delete($link->id);

        $this->assertDatabaseMissing($this->table, [
            'name'    => 'consensus',
            'coin_id' => $this->coin->id,
        ]);
    }

    public function providerCreate(): array
    {
        return [
            [['link' => 'test'], false],
            [['link' => 'test2'], false],
            [['link' => 'test3', 'field' => 'error'], true],
        ];
    }
}