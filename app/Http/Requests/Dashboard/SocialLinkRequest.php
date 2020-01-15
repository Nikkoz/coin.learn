<?php

namespace App\Http\Requests\Dashboard;

use App\Entities\Coin\Coin;
use App\Entities\Settings\SocialNetworks\SocialNetwork;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $link - ссылка
 */
class SocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'link'        => ['required', 'string', 'max:255'],
            'network_id'  => ['required', 'integer', Rule::in(SocialNetwork::all()->pluck('id')->toArray())],
            'description' => ['nullable', 'string'],
            'coin_id'     => ['required', 'integer', Rule::in(Coin::all()->pluck('id')->toArray())]
        ];
    }
}