<?php

use App\Entities\Coin\Coin;
use App\Entities\Coin\Handbook;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Handbook::class, static function (Faker $faker) {
    $title = $faker->unique()->lexify('???');

    $coins = Coin::all();
    $coinId = $coins->isEmpty() ? factory(Coin::class)->create()->id : $faker->randomElement($coins)->id;

    return [
        'title'      => $faker->toUpper($title),
        'alias'      => Str::slug($title),
        'coin_id'    => $coinId,
        'check_case' => $faker->boolean,
        'status'     => $faker->boolean
    ];
});
