<?php

namespace App\Http\Requests\Dashboard\Settings\SocialNetworks;

use App\Dictionaries\StatusDictionary;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property integer $id - Идентификатор соц. сети
 * @property string  $name
 */
class SocialNetworkRequest extends FormRequest
{
    /**
     * @var SocialNetwork
     */
    private $network;

    public function __construct(SocialNetwork $network, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->network = $network;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:100', Rule::unique($this->network->getTable())->ignore($this->id)],
            'link'   => ['required', 'string', 'max:100', Rule::unique($this->network->getTable())->ignore($this->id)],
            'status' => ['nullable', 'integer', Rule::in(StatusDictionary::getKeys())]
        ];
    }
}