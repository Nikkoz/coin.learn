<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Dictionaries\Handbook\CheckCaseDictionary;
use App\Dictionaries\StatusDictionary;
use App\Entities\Coin\Coin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HandbookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['required', 'string', 'max:4'],
            'coin_id'    => ['required', 'integer', Rule::in(Coin::all()->pluck('id')->toArray())],
            'check_case' => ['nullable', 'integer', Rule::in(CheckCaseDictionary::getKeys())],
            'status' => ['nullable', 'integer', Rule::in(StatusDictionary::getKeys())]
        ];
    }
}