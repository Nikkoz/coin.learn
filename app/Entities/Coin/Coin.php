<?php

namespace App\Entities\Coin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $code
 * @property string  $alias
 * @property integer $type
 * @property integer $publish
 * @property string  $image
 * @property integer $smart_contracts
 * @property string  $platform
 * @property string  $date_start
 * @property integer $encryption_id
 * @property integer $consensus_id
 * @property integer $mining
 * @property string  $max_supply
 * @property string  $key_features
 * @property string  $use
 * @property array   $site
 * @property array   $link
 * @property array   $forums
 * @property array   $chat
 * @property array   $source_code
 * @property integer $created_at
 * @property integer $updated_at
 */
class Coin extends Model
{
    public $guarded = ['id', 'alias'];
}
