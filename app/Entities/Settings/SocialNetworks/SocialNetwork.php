<?php

namespace App\Entities\Settings\SocialNetworks;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer       $id
 * @property string        $name
 * @property string        $link
 * @property boolean       $status
 * @property-read int|null $link_count
 *
 * @property SocialLink[]  $links
 *
 * @method static Builder|SocialNetwork newModelQuery()
 * @method static Builder|SocialNetwork newQuery()
 * @method static Builder|SocialNetwork query()
 * @method static Builder|SocialNetwork whereId($value)
 * @method static Builder|SocialNetwork whereLink($value)
 * @method static Builder|SocialNetwork whereName($value)
 * @method static Builder|SocialNetwork whereStatus($value)
 *
 * @mixin Eloquent
 */
class SocialNetwork extends Model
{
    public $guarded    = ['id'];

    public $timestamps = false;

    public function links(): HasMany
    {
        return $this->hasMany(SocialLink::class);
    }
}