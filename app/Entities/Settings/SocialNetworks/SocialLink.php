<?php

namespace App\Entities\Settings\SocialNetworks;

use App\Entities\Coin\Coin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer       $id
 * @property string        $link
 * @property integer       $network_id
 * @property integer       $coin_id
 * @property boolean       $status
 *
 * @property SocialNetwork $network
 * @property Coin          $coin
 */
class SocialLink extends Model
{
    public $guarded = ['id'];

    public $timestamps = false;

    public function network(): BelongsTo
    {
        return $this->belongsTo(SocialNetwork::class);
    }

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }
}
