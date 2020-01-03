<?php

use App\Entities\Coin\Consensus;
use Illuminate\Database\Seeder;

class ConsensusTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Consensus::class, 10)->create();
    }
}