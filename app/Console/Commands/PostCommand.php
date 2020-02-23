<?php

namespace App\Console\Commands;

use App\Events\PostImport;
use Illuminate\Support\Str;
use App\Console\BaseCommand;
use App\Managers\TwitterManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostCommand extends BaseCommand
{
    protected $signature   = 'post:import {type}';

    protected $description = 'Import posts';

    private   $twitterManager;

    public function __construct(TwitterManager $twitterManager)
    {
        parent::__construct();
        $this->twitterManager = $twitterManager;
    }

    public function handle(): int
    {
        $type = $this->argument('type');

        $status = static::OK;

        switch ($type) {
            case 'twitter':
                $manager = $this->twitterManager;
                break;
        }

        try {
            $manager->import();
        } catch (ModelNotFoundException $e) {
            $this->error('Network not found.');

            $status = static::ERROR;
        }

        event(new PostImport(Str::title($type), $status === static::OK ? 'success' : 'error'));

        return $status;
    }
}