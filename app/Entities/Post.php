<?php

namespace App\Entities;

use App\Entities\Coin\Coin;
use Illuminate\Support\Carbon;
use App\Entities\Settings\Site;
use App\Dictionaries\StatusDictionary;
use Illuminate\Database\Eloquent\Model;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property int    $type
 * @property int    $post_id
 * @property int    $coin_id
 * @property string $title
 * @property string $text
 * @property string $link
 * @property Carbon $created
 * @property string $section
 * @property int    $site_id
 * @property string $user_id
 * @property string $user_name
 * @property int    $shares
 * @property int    $likes
 * @property int    $comments
 * @property int    $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Coin   $coin
 * @property Site   $site
 *
 * @method Builder news()
 * @method Builder twitter()
 * @method Builder facebook()
 * @method Builder redit()
 * @method Builder active()
 */
class Post extends Model
{
    protected $guarded    = ['id'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function scopeNews(Builder $query): Builder
    {
        return $query->where('type', PostTypeDictionary::TYPE_POST);
    }

    public function scopeTwitter(Builder $query): Builder
    {
        return $query->where('type', PostTypeDictionary::TYPE_TWITTER);
    }

    public function scopeFacebook(Builder $query): Builder
    {
        return $query->where('type', PostTypeDictionary::TYPE_FACEBOOK);
    }

    public function scopeRedit(Builder $query): Builder
    {
        return $query->where('type', PostTypeDictionary::TYPE_REDIT);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', StatusDictionary::ACTIVE);
    }
}