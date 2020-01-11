<?php

namespace App\Dictionaries\SocialNetworks;

use App\Dictionaries\BaseDictionary;

class NetworkStatusDictionary extends BaseDictionary
{
    public const ACTIVE = 1;
    public const DISABLE = 0;

    public static function getValues(): array
    {
        return [
            static::ACTIVE  => trans('global.status.active'),
            static::DISABLE => trans('global.status.disable'),
        ];
    }
}