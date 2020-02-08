<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table      = 'formula';

    public    $timestamps = false;

    protected $guarded    = ['id'];

    protected $fillable   = [
        'news_max_val',
        'news_max_count',
        'community_max_val',
        'community_max_count',
        'developers_max_val',
        'developers_max_count',
        'exchanges_max_val',
        'exchanges_max_count',
    ];
}
