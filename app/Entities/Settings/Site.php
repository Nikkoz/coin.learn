<?php

namespace App\Entities\Settings;

use App\Entities\Post;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $link
 * @property string  $date
 * @property boolean $status
 *
 * @property Post[]  $posts
 *
 * @method Builder active()
 */
class Site extends Model
{
    protected $fillable   = ['name', 'link', 'date', 'status'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public    $timestamps = false;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', StatusDictionary::ACTIVE);
    }
}