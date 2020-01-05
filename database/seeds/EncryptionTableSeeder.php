<?php

use App\Entities\Settings\Encryption;
use Illuminate\Database\Seeder;

class EncryptionTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Encryption::class, 10)->create();
    }
}