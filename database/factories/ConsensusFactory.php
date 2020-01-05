<?php

use App\Entities\Settings\Consensus;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Consensus::class, static function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
    ];
});
