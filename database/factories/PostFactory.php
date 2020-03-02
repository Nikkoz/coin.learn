<?php

use App\Entities\Post;
use App\Entities\Coin\Coin;
use Faker\Generator as Faker;
use App\Entities\Settings\Site;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Post::class, static function (Faker $faker) {
    $type = $faker->randomElement(PostTypeDictionary::getKeys());

    if ($type === PostTypeDictionary::TYPE_POST) {
        $site = Site::query()->inRandomOrder()->first();
        $site = $site !== null ? factory(Site::class)->create()->id : $site->id;
    } else {
        $coin = Coin::query()->inRandomOrder()->first();
        $coin_id = $coin !== null ? factory(Coin::class)->create()->id : $coin->id;
    }

    return [
        'type'      => $type,
        'post_id'   => $type !== PostTypeDictionary::TYPE_POST ? $faker->randomNumber() : null,
        'coin_id'   => $coin_id ?? 0,
        'title'     => $faker->title,
        'text'      => $faker->text(150),
        'link'      => $faker->url,
        'created'   => $faker->dateTimeBetween('-1 year'),
        'section'   => $faker->firstNameMale,
        'site_id'   => $site ?? null,
        'user_id'   => $type !== PostTypeDictionary::TYPE_POST ? $faker->numberBetween(99999) : null,
        'user_name' => $type !== PostTypeDictionary::TYPE_POST ? $faker->firstNameMale : null,
        'shares'    => $type !== PostTypeDictionary::TYPE_POST ? $faker->numberBetween(0, 100) : 0,
        'likes'     => $type !== PostTypeDictionary::TYPE_POST ? $faker->numberBetween(0, 100) : 0,
        'comments'  => $type !== PostTypeDictionary::TYPE_POST ? $faker->numberBetween(0, 100) : 0,
        'status'    => $faker->boolean,
    ];
});