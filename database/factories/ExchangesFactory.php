<?php

use Faker\Generator as Faker;
use App\Entities\Settings\Exchange;
use Illuminate\Database\Eloquent\Factory;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

/** @var Factory $factory */

$factory->define(Exchange::class, static function (Faker $faker) {
    $network = SocialNetwork::all();
    $networkId = $network->isEmpty() ? factory(SocialNetwork::class)->create()->id : $faker->randomElement($network)->id;

    return [
        'name'        => $faker->unique()->firstNameMale,
        'link'        => $faker->unique()->url,
        'network_id'  => $networkId,
        'description' => $faker->text(150),
        'status'      => $faker->boolean,
    ];
});