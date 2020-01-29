<?php

namespace App\Entities\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

/**
 * @property int           $id
 * @property string        $name
 * @property string        $link
 * @property int           $network_id
 * @property string        $description
 * @property boolean       $status
 *
 * @property SocialNetwork $network
 */
class Exchange extends Model
{
    protected $fillable   = ['name', 'link', 'network_id', 'status', 'description'];

    public    $timestamps = false;

    public function network(): BelongsTo
    {
        return $this->belongsTo(SocialNetwork::class);
    }
}