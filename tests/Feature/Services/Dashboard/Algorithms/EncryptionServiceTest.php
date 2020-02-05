<?php

namespace Tests\Feature\Services\Dashboard\Algorithms;

use Exception;
use Throwable;
use Tests\DashboardTestCase;
use App\Entities\Settings\Encryption;
use App\Exceptions\FailedSaveModelException;
use App\Services\Dashboard\Algorithms\EncryptionService;

class EncryptionServiceTest extends DashboardTestCase
{
    private $table = 'algorithm_encryption';

    /**
     * @var EncryptionService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app()->make(EncryptionService::class);
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
        /** @var Encryption $encryption */
        $encryption = factory(Encryption::class)->create(['name' => 'encryption']);

        $this->service->update($encryption->id, ['name' => 'encryption_new']);

        $this->assertDatabaseHas($this->table, ['name' => 'encryption_new']);
        $this->assertDatabaseMissing($this->table, ['name' => 'encryption']);
    }

    /**
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Encryption $encryption */
        $encryption = factory(Encryption::class)->create(['name' => 'encryption']);

        $this->service->delete($encryption->id);

        $this->assertDatabaseMissing($this->table, ['name' => 'encryption']);
    }

    public function providerCreate(): array
    {
        return [
            [['name' => 'test']],
            [['name' => 'test2']],
        ];
    }
}