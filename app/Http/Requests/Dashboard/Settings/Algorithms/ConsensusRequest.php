<?php


namespace App\Http\Requests\Dashboard\Settings\Algorithms;


use App\Entities\Settings\Consensus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property integer $id - идентификатор алгоритма
 */
class ConsensusRequest extends FormRequest
{
    /**
     * @var Consensus
     */
    private $consensus;

    public function __construct(Consensus $consensus, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->consensus = $consensus;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique($this->consensus->getTable())->ignore($this->id)],
        ];
    }
}