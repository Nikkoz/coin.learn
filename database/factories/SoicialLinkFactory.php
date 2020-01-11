<?php

use App\Entities\Coin\Coin;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(SocialLink::class, static function (Faker $faker) {
    $network = SocialNetwork::all();
    $networkId = $network->isEmpty() ? factory(SocialNetwork::class)->create()->id : $faker->randomElement($network)->id;

    $coin = Coin::all();
    $coinId = $coin->isEmpty() ? factory(Coin::class)->create()->id : $faker->randomElement($coin)->id;

    return [
        'link'        => $faker->unique()->firstNameMale,
        'network_id'  => $networkId,
        'coin_id'     => $coinId,
        'description' => $faker->text(150),
    ];
});
