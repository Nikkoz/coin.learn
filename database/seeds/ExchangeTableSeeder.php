<?php

use Illuminate\Database\Seeder;
use App\Entities\Settings\Exchange;

class ExchangeTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Exchange::class, 50)->create();
    }
}