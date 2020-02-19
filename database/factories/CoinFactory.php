<?php

use App\Entities\Image;
use App\Entities\Coin\Coin;
use Faker\Generator as Faker;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Factory;
use App\Dictionaries\Coins\CoinTypeDictionary;

/** @var Factory $factory */

$factory->define(Coin::class, static function (Faker $faker) {
    $name = $faker->unique()->firstNameMale;

    $image = Image::where('name', '=', 'example.jpg')->first();
    $imageId = $image === null ? factory(Image::class)->create()->id : $image->id;

    $type = $faker->randomKey(CoinTypeDictionary::getValues());

    $encryption = Encryption::all();
    $encryptionId = $encryption->isEmpty() ? factory(Encryption::class)->create()->id : $encryption->random()->id;

    $consesus = Consensus::all();
    $consesusId = $consesus->isEmpty() ? factory(Consensus::class)->create()->id : $consesus->random()->id;

    return [
        'market_id'       => $faker->unique()->randomNumber(),
        'name'            => $name,
        'code'            => $faker->unique()->regexify('[A-Z]{3}'),
        'alias'           => Str::slug($name),
        'image_id'        => $imageId,
        'type'            => $type,
        'smart_contracts' => $type === CoinTypeDictionary::TYPE_COIN ? $faker->boolean : 0,
        'platform'        => $type === CoinTypeDictionary::TYPE_TOKEN ? $faker->word : '',
        'date_start'      => $faker->date('Y.m.d'),
        'encryption_id'   => $encryptionId,
        'consensus_id'    => $consesusId,
        'mining'          => $faker->boolean,
        'max_supply'      => $faker->numberBetween(1000000, 1000000000),
        'key_features'    => $faker->randomHtml(3, 1),
        'use'             => $faker->randomHtml(2, 2),
        'status'          => $faker->randomKey(StatusDictionary::getValues()),
        'uploaded'        => false,
    ];
});
