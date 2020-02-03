<?php

use App\Entities\Coin\Coin;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

/** @var Factory $factory */

$factory->define(SocialLink::class, static function (Faker $faker) {
    $network = SocialNetwork::all();
    $networkId = $network->isEmpty() ? factory(SocialNetwork::class)->create()->id : $network->random()->id;

    $coin = Coin::all();
    $coinId = $coin->isEmpty() ? factory(Coin::class)->create()->id : $coin->random()->id;

    return [
        'link'        => $faker->unique()->firstNameMale,
        'network_id'  => $networkId,
        'coin_id'     => $coinId,
        'description' => $faker->text(150),
    ];
});
