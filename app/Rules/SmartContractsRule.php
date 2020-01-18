<?php

namespace App\Rules;

use App\Dictionaries\Coins\CoinTypeDictionary;
use Illuminate\Contracts\Validation\Rule;

class SmartContractsRule implements Rule
{
    /**
     * @var int
     */
    private $type;

    public function __construct(?int $type)
    {
        $this->type = $type;
    }

    /**
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($this->type === CoinTypeDictionary::TYPE_TOKEN && $value === 1) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return trans('coin.validation.smart_contracts');
    }
}
