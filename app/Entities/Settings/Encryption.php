<?php

namespace App\Entities\Settings;

use App\Entities\Coin\Coin;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Entities\Settings\Encryption
 *
 * @property integer                $id
 * @property string                 $name
 * @property-read Collection|Coin[] $coin
 * @property-read int|null          $coin_count
 * @method static Builder|Encryption newModelQuery()
 * @method static Builder|Encryption newQuery()
 * @method static Builder|Encryption query()
 * @method static Builder|Encryption whereId($value)
 * @method static Builder|Encryption whereName($value)
 * @mixin Eloquent
 */
class Encryption extends Model
{
    protected $table = 'algorithm_encryption';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function coin(): HasMany
    {
        return $this->hasMany(Coin::class);
    }
}