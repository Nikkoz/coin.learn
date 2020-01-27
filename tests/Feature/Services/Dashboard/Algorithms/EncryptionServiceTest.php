<?php

namespace Tests\Feature\Services\Dashboard\Algorithms;

use App\Entities\Settings\Encryption;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use App\Services\Dashboard\Algorithms\EncryptionService;
use Exception;
use Tests\DashboardTestCase;
use Throwable;

class EncryptionServiceTest extends DashboardTestCase
{
    private $table = 'algorithm_encryption';

    /**
     * @var EncryptionService
     */
    private $service;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->service = new EncryptionService(new EncryptionRepository);
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