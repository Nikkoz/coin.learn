<?php

namespace App\Entities\Coin;

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
 * @property string  $image
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
 * @property array   $link
 * @property array   $forums
 * @property array   $chat
 * @property array   $source_code
 * @property integer $created_at
 * @property integer $updated_at
 */
class Coin extends Model
{
    /**
     * Путь для сохранения изображений фильмов.
     */
    public const PATH = 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'coins';

    public $guarded = ['id', 'alias'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function encryption(): BelongsTo
    {
        return $this->belongsTo(Encryption::class);
    }

    public function consensus(): BelongsTo
    {
        return $this->belongsTo(Consensus::class);
    }
}
