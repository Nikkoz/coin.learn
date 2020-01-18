<?php

namespace App\Entities;

use App\Entities\Coin\Coin;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Entities\Image
 *
 * @property integer   $id
 * @property string    $name
 * @property string    $path
 * @property string    $description
 * @property integer   $sort
 * @method static Builder|Image whereName($value)
 * @property-read Coin $coin
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereDescription($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereSort($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    public $guarded = ['id'];

    public $timestamps = false;

    public function coin(): HasOne
    {
        return $this->hasOne(Coin::class);
    }
}