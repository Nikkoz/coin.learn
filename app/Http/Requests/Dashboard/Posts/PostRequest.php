<?php

namespace App\Http\Requests\Dashboard\Posts;

use App\Entities\Coin\Coin;
use Illuminate\Validation\Rule;
use App\Entities\Settings\Site;
use App\Entities\Coin\Handbook;
use App\Dictionaries\StatusDictionary;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $type - тип поста
 * @property int $shares
 * @property int $likes
 * @property int $comments
 */
class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        if ((int)$this->type !== PostTypeDictionary::TYPE_POST) {
            $this->request->set('shares', (int)$this->shares);
            $this->request->set('likes', (int)$this->likes);
            $this->request->set('comments', (int)$this->comments);
        }
    }

    public function rules(): array
    {
        return [
            'type'        => ['required', 'integer', Rule::in(PostTypeDictionary::getKeys())],
            'post_id'     => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:255',
            ],
            'coin_id'     => ['nullable', 'integer', Rule::in(Coin::all()->pluck('id')->toArray())],
            'title'       => [
                Rule::requiredIf(function () {
                    return (int)$this->type === PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:255',
            ],
            'text'        => ['required', 'string'],
            'link'        => [
                Rule::requiredIf(function () {
                    return (int)$this->type === PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:255',
            ],
            'handbooks'   => ['nullable', 'array'],
            'handbooks.*' => ['integer', Rule::in(Handbook::all()->pluck('id')->toArray())],
            'created'     => ['required', 'date_format:Y-m-d H:i'],
            'section'     => [
                Rule::requiredIf(function () {
                    return (int)$this->type === PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:100',
            ],
            'site_id'     => [
                Rule::requiredIf(function () {
                    return (int)$this->type === PostTypeDictionary::TYPE_POST;
                }),
                'integer',
                Rule::in(Site::all()->pluck('id')->toArray()),
            ],
            'user_id'     => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:20',
            ],
            'user_name'   => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'string',
                'max:10',
            ],
            'shares'      => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'integer',
            ],
            'likes'       => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'integer',
            ],
            'comments'    => [
                Rule::requiredIf(function () {
                    return (int)$this->type !== PostTypeDictionary::TYPE_POST;
                }),
                'integer',
            ],
            'status'      => ['nullable', 'integer', Rule::in(StatusDictionary::getKeys())],
        ];
    }
}