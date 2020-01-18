<?php

namespace App\Entities\Settings\SocialNetworks;

use App\Entities\Coin\Coin;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer       $id
 * @property string        $link
 * @property integer       $network_id
 * @property integer       $coin_id
 * @property string        $description
 *
 * @property SocialNetwork $network
 * @property Coin          $coin
 *
 * @method static Builder|SocialLink newModelQuery()
 * @method static Builder|SocialLink newQuery()
 * @method static Builder|SocialLink query()
 * @method static Builder|SocialLink whereCoinId($value)
 * @method static Builder|SocialLink whereDescription($value)
 * @method static Builder|SocialLink whereId($value)
 * @method static Builder|SocialLink whereLink($value)
 * @method static Builder|SocialLink whereNetworkId($value)
 *
 * @mixin Eloquent
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
