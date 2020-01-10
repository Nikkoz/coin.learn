<?php

namespace App\Entities\Settings;

use App\Entities\Coin\Coin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string  $name
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