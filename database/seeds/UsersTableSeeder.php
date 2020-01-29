<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [[
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => Hash::make('1q2w3e4r'),
            'remember_token' => null,
            'admin'          => true,
        ]];

        foreach ($users as $user) {
            factory(User::class, 1)->create($user);
        }

        factory(User::class, 4)->create();
    }
}