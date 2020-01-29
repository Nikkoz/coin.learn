<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Dictionaries\StatusDictionary;
use App\Entities\Settings\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $id - идентификатор сайта
 */
class SiteRequest extends FormRequest
{
    private $site;

    public function __construct(
        Site $site,
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

        $this->site = $site;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:100', Rule::unique($this->site->getTable())->ignore($this->id)],
            'link'   => ['required', 'string', 'max:255', Rule::unique($this->site->getTable())->ignore($this->id)],
            'status' => ['nullable', 'integer', Rule::in(StatusDictionary::getKeys())]
        ];
    }
}