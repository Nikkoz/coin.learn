<?php

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Illuminate\Database\Seeder;

class SocialNetworkTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(SocialNetwork::class, 5)->create();
    }
}