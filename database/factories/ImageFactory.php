<?php

use App\Entities\Image;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Image::class, static function (Faker $faker) {
    return [
        'name'        => 'example.jpg',
        'path'        => 'public/images/example.jpg',
        'description' => 'Тестовый файл',
        'sort'        => 1
    ];
});