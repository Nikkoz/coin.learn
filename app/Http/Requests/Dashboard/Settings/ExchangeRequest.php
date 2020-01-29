<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Validation\Rule;
use App\Entities\Settings\Exchange;
use App\Dictionaries\StatusDictionary;
use Illuminate\Foundation\Http\FormRequest;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

/**
 * @property int $id - Идентификатор биржы
 */
class ExchangeRequest extends FormRequest
{
    private $exchange;

    public function __construct(
        Exchange $exchange,

        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    )
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->exchange = $exchange;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => [
                'required',
                'string',
                'max:100',
                Rule::unique($this->exchange->getTable())->ignore($this->id),
            ],
            'link'        => [
                'required',
                'string',
                'max:255',
                Rule::unique($this->exchange->getTable())->ignore($this->id),
            ],
            'network_id'  => ['required', 'integer', Rule::in(SocialNetwork::query()->active()->pluck('id')
                ->toArray())],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'integer', Rule::in(StatusDictionary::getKeys())],
        ];
    }
}