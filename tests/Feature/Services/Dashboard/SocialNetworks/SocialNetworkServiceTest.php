<?php

namespace Tests\Feature\Services\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;
use App\Services\Dashboard\SocialNetworks\SocialNetworkService;
use Tests\DashboardTestCase;
use Throwable;

class SocialNetworkServiceTest extends DashboardTestCase
{
    private $table = 'social_networks';

    /**
     * @var SocialNetworkService
     */
    private $service;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->service = new SocialNetworkService(new SocialNetworkRepository);
    }

    /**
     * @param array $data
     * @param bool $error
     * @throws Throwable
     *
     * @dataProvider providerCreate
     */
    public function testCreate(array $data, bool $error): void
    {
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
        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create(['name' => 'Vk', 'link' => 'old']);

        $this->service->update($network->id, ['link' => 'new']);

        $this->assertDatabaseHas($this->table, ['name' => 'Vk', 'link' => 'new']);
        $this->assertDatabaseMissing($this->table, ['name' => 'Vk', 'link' => 'old']);
    }

    public function testDelete(): void
    {
        /** @var SocialNetwork $network */
        $network = factory(SocialNetwork::class)->create(['name' => 'Vk', 'link' => 'old']);

        $this->service->delete($network->id);

        $this->assertDatabaseMissing($this->table, [
            'name' => 'Vk',
            'link' => 'old'
        ]);
    }

    public function providerCreate(): array
    {
        return [
            [['link' => 'http://vk.com', 'name' => 'Vk'], false],
            [['link' => 'http://facebook.com', 'name' => 'Fb'], false],
            [['link' => 'http://od.com', 'name' => 'Od', 'field' => 'error'], true],
        ];
    }
}