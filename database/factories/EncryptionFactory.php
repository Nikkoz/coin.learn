<?php

use App\Entities\Settings\Encryption;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Encryption::class, static function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstNameMale,
    ];
});
