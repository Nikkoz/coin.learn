<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class FormulaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'news_max_val'         => ['required', 'integer'],
            'news_max_count'       => ['required', 'integer'],
            'community_max_val'    => ['required', 'integer'],
            'community_max_count'  => ['required', 'integer'],
            'developers_max_val'   => ['required', 'integer'],
            'developers_max_count' => ['required', 'integer'],
            'exchanges_max_val'    => ['required', 'integer'],
            'exchanges_max_count'  => ['required', 'integer'],
        ];
    }
}