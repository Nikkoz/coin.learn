<?php

namespace App\Console;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
    public const ERROR = 0;
    public const OK    = 1;
}