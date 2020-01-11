<?php

namespace App\Entities\Settings\SocialNetworks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $link
 * @property boolean $status
 */
class SocialNetwork extends Model
{
    public $guarded = ['id'];

    public $timestamps = false;

    public function link(): HasMany
    {
        return $this->hasMany(SocialLink::class);
    }
}