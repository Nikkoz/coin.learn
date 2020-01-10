<?php

namespace App\Entities\Coin;

use App\Entities\Image;
use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $code
 * @property string  $alias
 * @property integer $type
 * @property integer $publish
 * @property integer $image_id
 * @property integer $smart_contracts
 * @property string  $platform
 * @property string  $date_start
 * @property integer $encryption_id
 * @property integer $consensus_id
 * @property integer $mining
 * @property string  $max_supply
 * @property string  $key_features
 * @property string  $use
 * @property array   $site
 * @property array   $links
 * @property array   $forums
 * @property array   $chat
 * @property array   $source_code
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Image   $image
 */
class Coin extends Model
{
    /**
     * Путь для сохранения изображений фильмов.
     */
    public const PATH = 'images' . DIRECTORY_SEPARATOR . 'coins';

    public $guarded = ['id', 'alias'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'links' => 'array'
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
        return $this->belongsTo(Image::class);
    }
}
