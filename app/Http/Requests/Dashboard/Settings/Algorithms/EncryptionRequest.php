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
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('algorithm_encryption')->ignore($this->id)],
        ];
    }
}