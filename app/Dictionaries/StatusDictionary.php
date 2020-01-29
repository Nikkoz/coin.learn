<?php

namespace App\Dictionaries;

class StatusDictionary extends BaseDictionary
{
    public const ACTIVE   = 1;
    public const DISABLED = 0;

    public static function getValues(): array
    {
        return [
            static::ACTIVE   => trans('global.status.active'),
            static::DISABLED => trans('global.status.disable'),
        ];
    }
}