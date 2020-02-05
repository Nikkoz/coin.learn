<?php

namespace Tests\Feature\Services\Dashboard\Algorithms;

use Exception;
use Throwable;
use Tests\DashboardTestCase;
use App\Entities\Settings\Consensus;
use App\Exceptions\FailedSaveModelException;
use App\Services\Dashboard\Algorithms\ConsensusService;

class ConsensusServiceTest extends DashboardTestCase
{
    private $table = 'algorithm_consensus';

    /**
     * @var ConsensusService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app()->make(ConsensusService::class);
    }

    /**
     * @param array $data
     *
     * @dataProvider providerCreate
     * @throws Throwable
     */
    public function testCreate(array $data): void
    {
        $this->service->create($data);

        $this->assertDatabaseHas($this->table, $data);
    }

    /**
     * @throws Throwable
     * @throws FailedSaveModelException
     */
    public function testUpdate(): void
    {
        /** @var Consensus $consensus */
        $consensus = factory(Consensus::class)->create(['name' => 'consensus']);

        $this->service->update($consensus->id, ['name' => 'consensus_new']);

        $this->assertDatabaseHas($this->table, ['name' => 'consensus_new']);
        $this->assertDatabaseMissing($this->table, ['name' => 'consensus']);
    }

    /**
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Consensus $consensus */
        $consensus = factory(Consensus::class)->create(['name' => 'consensus']);

        $this->service->delete($consensus->id);

        $this->assertDatabaseMissing($this->table, ['name' => 'consensus']);
    }

    public function providerCreate(): array
    {
        return [
            [['name' => 'test']],
            [['name' => 'test2']],
        ];
    }
}