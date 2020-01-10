<?php


namespace App\Http\Requests\Dashboard\Settings\Algorithms;


use App\Entities\Settings\Encryption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property integer $id - идентификатор алгоритма
 */
class EncryptionRequest extends FormRequest
{
    /**
     * @var Encryption
     */
    private $encryption;

    public function __construct(Encryption $encryption, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->encryption = $encryption;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique($this->encryption->getTable())->ignore($this->id)],
        ];
    }
}