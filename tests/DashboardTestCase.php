<?php

namespace Tests;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use UsersTableSeeder;

/**
 * Абстрактный класс для http тестов админ. панели.
 */
class DashboardTestCase extends TestCase
{
    use RefreshDatabase;

    /**
     * {@inheritDoc}
     *
     * Запуск сидов для пользователей.
     * Авторизируем администратора.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UsersTableSeeder::class);

        $user = User::query()->whereAdmin(true)->firstOrFail();
        $this->actingAs($user, 'web');
    }
}