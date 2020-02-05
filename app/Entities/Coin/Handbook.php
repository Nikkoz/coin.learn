<?php

namespace App\Entities\Coin;

use App\Entities\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property integer $coin_id
 * @property integer $check_case
 * @property integer $status
 *
 * @property Coin    $coin
 * @property Post[]  $posts
 */
class Handbook extends Model
{
    public $guarded    = ['id', 'alias'];

    public $timestamps = false;

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_handbook_assignments');
    }
}
