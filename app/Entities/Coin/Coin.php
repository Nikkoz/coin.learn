<?php

namespace App\Entities\Coin;

use App\Entities\Post;
use App\Entities\Image;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Contracts\Filters\DataFilterable;
use App\Dictionaries\Coins\CoinTypeDictionary;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Entities\Settings\SocialNetworks\SocialLink;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer      $id
 * @property string       $name
 * @property string       $code
 * @property string       $alias
 * @property integer      $type
 * @property integer      $status
 * @property integer      $image_id
 * @property integer      $smart_contracts
 * @property string       $platform
 * @property string       $date_start
 * @property integer      $encryption_id
 * @property integer      $consensus_id
 * @property integer      $mining
 * @property string       $max_supply
 * @property string       $key_features
 * @property string       $use
 * @property array        $site
 * @property array        $links
 * @property array        $forums
 * @property array        $chat
 * @property array        $source_code
 * @property integer      $created_at
 * @property integer      $updated_at
 *
 * @property Image        $image
 * @property SocialLink[] $socialLinks
 * @property Handbook[]   $handbooks
 * @property Post[]       $posts
 *
 * @method Builder active()
 */
class Coin extends Model implements DataFilterable
{
    /**
     * Путь для сохранения изображений фильмов.
     */
    public const PATH = 'images' . DIRECTORY_SEPARATOR . 'coins';

    public    $guarded    = ['id', 'alias'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts      = [
        'links' => 'array',
    ];

    public function encryption(): BelongsTo
    {
        return $this->belongsTo(Encryption::class);
    }

    public function consensus(): BelongsTo
    {
        return $this->belongsTo(Consensus::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class)->withDefault();
    }

    public function socialLinks(): HasMany
    {
        return $this->hasMany(SocialLink::class)->with('network');
    }

    public function handbooks(): HasMany
    {
        return $this->hasMany(Handbook::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', StatusDictionary::ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function getDataFilterConfig(): array
    {
        return [
            [
                'condition' => function () {
                    return (int)$this->type === CoinTypeDictionary::TYPE_COIN;
                },
                'filter'    => function () {
                    $this->platform = null;
                },
            ], [
                'condition' => function () {
                    return (int)$this->type === CoinTypeDictionary::TYPE_TOKEN;
                },
                'filter'    => function () {
                    $this->smart_contracts = false;
                },
            ],
        ];
    }
}
