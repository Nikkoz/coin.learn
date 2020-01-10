<?php

namespace App\Entities;

use App\Entities\Coin\Coin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $path
 * @property string  $description
 * @property integer $sort
 *
 * @method static Builder|Image whereName($value)
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