<?php

use App\Entities\Settings\Site;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Site::class, static function (Faker $faker) {
    return [
        'name'   => $faker->unique()->firstNameMale,
        'link'   => $faker->unique()->url,
        'upload' => $faker->date('Y-m-d H:i:sO'),
        'status' => $faker->boolean,
    ];
});