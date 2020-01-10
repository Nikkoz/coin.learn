<?php


namespace App\Http\Requests\Dashboard;


use App\Dictionaries\Coins\CoinStatusDictionary;
use App\Dictionaries\Coins\CoinTypeDictionary;
use App\Entities\Coin\Coin;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use App\Rules\SmartContractsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $id - Идентификатор монеты
 * @property int $type - Выбранный тип (Монета или Токен)
 */
class CoinRequest extends FormRequest
{
    /**
     * @var Coin
     */
    private $coin;

    public function __construct(Coin $coin, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->coin = $coin;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:100', Rule::unique($this->coin->getTable())->ignore($this->id)],
            'code'            => ['required', 'string', 'max:10', Rule::unique($this->coin->getTable())->ignore($this->id)],
            'type'            => ['required', 'integer', Rule::in(CoinTypeDictionary::getKeys())],
            'smart_contracts' => ['nullable', new SmartContractsRule($this->type)],
            'platform'        => ['nullable', 'string', 'max:255'],
            'date_start'      => ['nullable', 'date', 'date_format:Y-m-d'],
            'encryption_id'   => ['nullable', Rule::in(Encryption::all()->pluck('id')->toArray())],
            'consensus_id'    => ['nullable', Rule::in(Consensus::all()->pluck('id')->toArray())],
            'mining'          => ['nullable', 'integer'],
            'max_supply'      => ['nullable', 'integer'],
            'key_features'    => ['nullable', 'min:10'],
            'use'             => ['nullable', 'min:10'],
            'status'          => ['nullable', 'integer', Rule::in(CoinStatusDictionary::getKeys())],
            'site'            => ['nullable', 'string', 'max:50'],
            'chat'            => ['nullable', 'string', 'max:50'],
            'links'           => ['nullable', 'array'],
            'links.*'         => ['nullable', 'distinct', 'string', 'max:50'],
            'image_id'        => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
        ];
    }
}