<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
    public $timestamps = false;
}