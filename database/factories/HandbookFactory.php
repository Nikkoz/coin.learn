<?php

use App\Entities\Coin\Coin;
use Faker\Generator as Faker;
use App\Entities\Coin\Handbook;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Handbook::class, static function (Faker $faker) {
    $title = $faker->unique()->lexify('???');

    $coin = Coin::query()->inRandomOrder()->first();
    $coinId = $coin !== null ? factory(Coin::class)->create()->id : $coin->id;

    return [
        'title'      => $faker->toUpper($title),
        'alias'      => Str::slug($title),
        'coin_id'    => $coinId,
        'check_case' => $faker->boolean,
        'status'     => $faker->boolean,
    ];
});
