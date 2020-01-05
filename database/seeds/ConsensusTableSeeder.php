<?php

use App\Entities\Settings\Consensus;
use Illuminate\Database\Seeder;

class ConsensusTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Consensus::class, 10)->create();
    }
}