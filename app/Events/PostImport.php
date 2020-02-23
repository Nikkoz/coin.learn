<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PostImport
{
    use Dispatchable, SerializesModels;

    public $type;

    public $result;

    public function __construct(string $type, string $result = 'success')
    {
        $this->type = $type;
        $this->result = $result;
    }
}