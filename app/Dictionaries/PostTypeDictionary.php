<?php

namespace App\Dictionaries;

class  PostTypeDictionary extends BaseDictionary
{
    public const TYPE_POST     = 1;
    public const TYPE_TWITTER  = 2;
    public const TYPE_FACEBOOK = 3;
    public const TYPE_REDIT    = 4;

    /**
     * @inheritDoc
     */
    public static function getValues(): array
    {
        return [
            static::TYPE_POST     => trans('global.post_types.post'),
            static::TYPE_TWITTER  => trans('global.post_types.twitter'),
            static::TYPE_FACEBOOK => trans('global.post_types.facebook'),
            static::TYPE_REDIT    => trans('global.post_types.reddit'),
        ];
    }
}