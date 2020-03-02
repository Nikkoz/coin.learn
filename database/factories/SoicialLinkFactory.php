<?php

use App\Entities\Coin\Coin;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

/** @var Factory $factory */

$factory->define(SocialLink::class, static function (Faker $faker) {
    $network = SocialNetwork::query()->inRandomOrder()->first();
    $networkId = $network !== null ? factory(SocialNetwork::class)->create()->id : $network->id;

    $coin = Coin::query()->inRandomOrder()->first();
    $coinId = $coin !== null ? factory(Coin::class)->create()->id : $coin->id;

    return [
        'link'        => $faker->unique()->firstNameMale,
        'network_id'  => $networkId,
        'coin_id'     => $coinId,
        'description' => $faker->text(150),
    ];
});
