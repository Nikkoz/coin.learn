<?php

use App\Entities\Coin\Coin;
use Illuminate\Database\Seeder;

class CoinsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Coin::class, 20)->create();
    }
}