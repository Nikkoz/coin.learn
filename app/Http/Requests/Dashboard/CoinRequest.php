<?php


namespace App\Http\Requests\Dashboard;


use App\Dictionaries\Coins\CoinStatusDictionary;
use App\Dictionaries\Coins\CoinTypeDictionary;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use App\Rules\SmartContractsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int   $id - Идентификатор монеты
 * @property int   $type - Выбранный тип (Монета или Токен)
 * @property array $link - массив дополнительный ссылок
 */
class CoinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('coins')->ignore($this->id)],
            'code' => ['required', 'string', 'max:10', Rule::unique('coins')->ignore($this->id)],
            'type' => ['required', 'integer', Rule::in(CoinTypeDictionary::getKeys())],
            'smart_contracts' => ['nullable', new SmartContractsRule($this->type)],
            'platform' => ['nullable', 'string', 'max:255'],
            'date_start' => ['nullable', 'date', 'date_format:Y-m-d'],
            'encryption' => ['nullable', Rule::in(Encryption::all()->pluck('id')->toArray())],
            'consensus' => ['nullable', Rule::in(Consensus::all()->pluck('id')->toArray())],
            'mining' => ['nullable', 'integer'],
            'max_supply' => ['nullable', 'integer'],
            'key_features' => ['nullable', 'min:10'],
            'use' => ['nullable', 'min:10'],
            'status' => ['nullable', 'integer', Rule::in(CoinStatusDictionary::getKeys())],
            'site' => ['nullable', 'string', 'max:50'],
            'chat' => ['nullable', 'string', 'max:50'],
            'link' => ['nullable', 'array'],
            'link.*' => ['nullable', 'distinct', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
        ];
    }
}