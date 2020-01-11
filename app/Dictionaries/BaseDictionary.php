<?php

namespace App\Dictionaries;

use Exception;
use Illuminate\Support\Arr;

abstract class BaseDictionary
{
    /**
     * Получить содержание словаря.
     *
     * @return array
     */
    abstract public static function getValues(): array;

    /**
     * Получить ключи словаря.
     *
     * @return array
     */
    public static function getKeys(): array
    {
        return array_keys(static::getValues());
    }

    /**
     * Получить значение словаря по ключу.
     *
     * @param mixed $key
     *
     * @throws Exception
     * @return mixed
     */
    public static function getValueByKey($key)
    {
        $value = Arr::get(static::getValues(), $key);
        if ($value === null) {
            throw new \RuntimeException('Dictionary ' . self::class . ' not found value by key <' . $key . '>.');
        }

        return $value;
    }

    /**
     * Получить значения справочника по конкретным ключам.
     *
     * @param array $keys
     *
     * @return array
     */
    public static function getValueByKeys(array $keys): array
    {
        self::validateKeys($keys);

        return Arr::only(static::getValues(), $keys);
    }

    /**
     * Получить значения справочника без конкретных ключей.
     *
     * @param array $keys
     *
     * @return array
     */
    public static function getValueWithoutKeys(array $keys): array
    {
        self::validateKeys($keys);

        return Arr::except(static::getValues(), $keys);
    }

    /**
     * Валидируем переданные ключи.
     *
     * @param array $keys
     */
    private static function validateKeys(array $keys): void
    {
        foreach ($keys as $key) {
            if (Arr::exists(static::getValues(), $key) === false) {
                throw new \InvalidArgumentException('Invalid keys.');
            }
        }
    }
}