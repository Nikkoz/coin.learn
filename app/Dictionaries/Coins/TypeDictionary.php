<?php

namespace App\Dictionaries\Coins;

use App\Dictionaries\BaseDictionary;

class TypeDictionary extends BaseDictionary
{
    public const TYPE_COIN = 1;
    public const TYPE_TOKEN = 2;

    public static function getValues(): array
    {
        return [
            self::TYPE_COIN => trans('coin.type.coin'),
            self::TYPE_TOKEN => trans('coin.type.token'),
        ];
    }
}