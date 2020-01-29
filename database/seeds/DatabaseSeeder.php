<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EncryptionTableSeeder::class);
        $this->call(ConsensusTableSeeder::class);
        $this->call(CoinsTableSeeder::class);
        $this->call(SocialNetworkTableSeeder::class);
        $this->call(SocialLinksTableSeeder::class);
        $this->call(HandbookTableSeeder::class);
        $this->call(SiteTableSeeder::class);
    }
}
