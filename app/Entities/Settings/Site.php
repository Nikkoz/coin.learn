<?php

namespace App\Entities\Settings;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $date
 * @property boolean $status
 */
class Site extends Model
{
    protected $fillable = ['name', 'link', 'date', 'status'];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public $timestamps = false;
}