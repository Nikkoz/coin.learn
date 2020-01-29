<?php

namespace App\Entities\Settings\SocialNetworks;

use Eloquent;
use App\Entities\Settings\Exchange;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer       $id
 * @property string        $name
 * @property string        $link
 * @property boolean       $status
 * @property-read int|null $link_count
 *
 * @property SocialLink[]  $links
 * @property Exchange[]    $exchanges
 *
 * @method static Builder|SocialNetwork newModelQuery()
 * @method static Builder|SocialNetwork newQuery()
 * @method static Builder|SocialNetwork query()
 * @method static Builder|SocialNetwork whereId($value)
 * @method static Builder|SocialNetwork whereLink($value)
 * @method static Builder|SocialNetwork whereName($value)
 * @method static Builder|SocialNetwork whereStatus($value)
 *
 * @method Builder active()
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

    public function exchanges(): HasMany
    {
        return $this->hasMany(Exchange::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', StatusDictionary::ACTIVE);
    }
}