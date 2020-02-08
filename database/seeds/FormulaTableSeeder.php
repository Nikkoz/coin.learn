<?php

use App\Entities\Formula;
use Illuminate\Database\Seeder;

class FormulaTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Formula::class)->create();
    }
}
