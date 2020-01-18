<?php

namespace App\Dictionaries\Handbook;

use App\Dictionaries\BaseDictionary;

class CheckCaseDictionary extends BaseDictionary
{
    public const CHECK     = 1;
    public const NOT_CHECK = 0;

    /**
     * @inheritDoc
     */
    public static function getValues(): array
    {
        return [
            self::NOT_CHECK => trans('handbooks.not_check'),
            self::CHECK     => trans('handbooks.check'),
        ];
    }
}