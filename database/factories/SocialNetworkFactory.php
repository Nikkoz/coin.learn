<?php

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(SocialNetwork::class, static function (Faker $faker) {
    return [
        'name'   => $faker->unique()->firstNameMale,
        'link'   => $faker->unique()->url,
        'status' => $faker->boolean,
    ];
});