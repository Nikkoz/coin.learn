<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [[
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$ech0JG.eXEEcWCaU8yAL3eokWmIIfshkzzw4UI3VKueX89hXClivK', // 1q2w3e4r
            'remember_token' => null,
            'admin' => true,
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ]];

        User::insert($users);
    }
}