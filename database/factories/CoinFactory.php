<?php

use App\Dictionaries\Coins\CoinStatusDictionary;
use App\Dictionaries\Coins\CoinTypeDictionary;
use App\Entities\Coin\Coin;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use App\Entities\Image;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Coin::class, static function (Faker $faker) {
    $name = $faker->firstNameMale;

    $image = Image::where('name', '=', 'example.jpg')->first();
    $imageId = $image === null ? factory(Image::class)->create()->id : $image->id;

    $type = $faker->randomKey(CoinTypeDictionary::getValues());

    $encryption = Encryption::all();
    $encryptionId = $encryption->isEmpty() ? factory(Encryption::class)->create()->id : $faker->randomElement($encryption)->id;

    $consesus = Consensus::all();
    $consesusId = $consesus->isEmpty() ? factory(Consensus::class)->create()->id : $faker->randomElement($consesus)->id;

    return [
        'name' => $name,
        'code' => $faker->regexify('[A-Z]{3}'),
        'slug' => Str::slug($name),
        'image' => $imageId,
        'type' => $type,
        'smart_contracts' => $type === CoinTypeDictionary::TYPE_COIN ? $faker->boolean : 0,
        'platform' => $type === CoinTypeDictionary::TYPE_TOKEN ? $faker->word : '',
        'date_start' => $faker->date('d.m.Y'),
        'encryption' => $encryptionId,
        'consensus' => $consesusId,
        'mining' => $faker->boolean,
        'max_supply' => $faker->numberBetween(1000000, 1000000000),
        'key_features' => $faker->text(210),
        'use' => $faker->text(100),
        'status' => $faker->randomKey(CoinStatusDictionary::getValues()),
    ];
});
