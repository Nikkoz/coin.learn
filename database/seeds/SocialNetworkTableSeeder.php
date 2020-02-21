<?php

use Illuminate\Database\Seeder;
use App\Dictionaries\StatusDictionary;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

class SocialNetworkTableSeeder extends Seeder
{
    public function run(): void
    {
        $networks = [
            [
                'name'   => 'Twitter',
                'link'   => 'https://twitter.com/',
                'status' => StatusDictionary::ACTIVE,
            ], [
                'name'   => 'Facebook',
                'link'   => 'https://www.facebook.com/',
                'status' => StatusDictionary::ACTIVE,
            ], [
                'name'   => 'Reddit',
                'link'   => 'https://www.reddit.com/',
                'status' => StatusDictionary::ACTIVE,
            ],
        ];

        foreach ($networks as $network) {
            factory(SocialNetwork::class, 1)->create($network);
        }

        factory(SocialNetwork::class, 5)->create();
    }
}