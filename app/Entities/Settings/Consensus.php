<?php

namespace App\Entities\Settings;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $name
 */
class Consensus extends Model
{
    protected $table = 'algorithm_consensus';

    protected $fillable = ['name'];

    public $timestamps = false;
}