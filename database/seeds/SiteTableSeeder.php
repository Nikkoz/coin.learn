<?php

use App\Entities\Settings\Site;
use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Site::class, 10)->create();
    }
}