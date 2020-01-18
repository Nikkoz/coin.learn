<?php

namespace App\Entities\Settings;

use App\Entities\Coin\Coin;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Entities\Settings\Consensus
 *
 * @property integer                $id
 * @property string                 $name
 * @property-read Collection|Coin[] $coin
 * @property-read int|null          $coin_count
 * @method static Builder|Consensus newModelQuery()
 * @method static Builder|Consensus newQuery()
 * @method static Builder|Consensus query()
 * @method static Builder|Consensus whereId($value)
 * @method static Builder|Consensus whereName($value)
 * @mixin Eloquent
 */
class Consensus extends Model
{
    protected $table = 'algorithm_consensus';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function coin(): HasMany
    {
        return $this->hasMany(Coin::class);
    }
}