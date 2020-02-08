<?php

use App\Entities\Formula;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Formula::class, static function (Faker $faker) {
    return [
        'news_max_val'         => 60,
        'news_max_count'       => 2,
        'community_max_val'    => 10,
        'community_max_count'  => 10000,
        'developers_max_val'   => 20,
        'developers_max_count' => 5,
        'exchanges_max_val'    => 10,
        'exchanges_max_count'  => 2,
    ];
});
