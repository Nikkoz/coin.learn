<?php

namespace App\Dictionaries\Coins;

use App\Dictionaries\BaseDictionary;

class StatusDictionary extends BaseDictionary
{
    public const ACTIVE = 1;
    public const DRAFT = 0;

    public static function getValues(): array
    {
        return [
            static::ACTIVE => trans('global.status.active'),
            static::DRAFT => trans('global.status.draft'),
        ];
    }
}