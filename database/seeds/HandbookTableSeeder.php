<?php

use App\Entities\Coin\Handbook;
use Illuminate\Database\Seeder;

class HandbookTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Handbook::class, 200)->create();
    }
}