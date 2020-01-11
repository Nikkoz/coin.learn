<?php

use App\Entities\Settings\SocialNetworks\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinksTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(SocialLink::class, 50)->create();
    }
}