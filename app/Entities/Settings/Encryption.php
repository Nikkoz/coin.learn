<?php

namespace App\Entities\Settings;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $name
 */
class Encryption extends Model
{
    protected $table = 'algorithm_encryption';

    protected $fillable = ['name'];

    public $timestamps = false;
}