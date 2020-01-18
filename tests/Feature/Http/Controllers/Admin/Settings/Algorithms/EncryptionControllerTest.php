<?php

namespace Tests\Feature\Http\Controllers\Admin\Settings\Algorithms;

use App\Entities\Settings\Encryption;
use Tests\DashboardTestCase;

class EncryptionControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        $response = $this->get(route('admin.settings.algorithms.encryption.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('admin.settings.algorithms.encryption.create'));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     * @param array $params
     * @param bool $isError
     */
    public function testStore(array $params, bool $isError): void
    {
        $response = $this->post(route('admin.settings.algorithms.encryption.store'), $params);
        $response->assertStatus(302);

        if ($isError) {
            $response->assertSessionHas('errors');
        } else {
            $this->assertDatabaseHas('algorithm_encryption', $params);
        }
    }

    public function testEdit(): void
    {
        /** @var Encryption $algorithm */
        $algorithm = factory(Encryption::class)->create();

        $response = $this->get(route('admin.settings.algorithms.encryption.edit', $algorithm->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Encryption $algorithm */
        $algorithm = factory(Encryption::class)->create();

        $response = $this->put(route('admin.settings.algorithms.encryption.update', $algorithm->id), [
            'name' => 'new',
        ]);
        $response->assertStatus(302);

        $algorithm->refresh();

        $this->assertDatabaseHas('algorithm_encryption', [
            'id'   => $algorithm->id,
            'name' => $algorithm->name
        ]);
    }

    public function testDelete(): void
    {
        /** @var Encryption $algorithm */
        $algorithm = factory(Encryption::class)->create();

        $response = $this->delete(route('admin.settings.algorithms.encryption.destroy', $algorithm->id));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('algorithm_encryption', [
            'id' => $algorithm->id
        ]);
    }

    public function providerStore(): array
    {
        return [
            [['name' => 'test'], false], // сохраниться
            [['name' => ''], true], // не сохранится, ошибка валидации, обязательное поле
        ];
    }
}