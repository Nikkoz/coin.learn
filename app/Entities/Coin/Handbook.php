<?php

namespace App\Entities\Coin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property integer $coin_id
 * @property integer $check_case
 * @property integer $status
 *
 * @property Coin    $coin
 */
class Handbook extends Model
{
    public $guarded    = ['id', 'alias'];

    public $timestamps = false;

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }
}
