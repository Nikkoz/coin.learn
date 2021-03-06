<?php

namespace App\Providers;

use App\Events\PostImport;
use App\Listeners\PostImportListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostImport::class => [
            PostImportListener::class,
        ],
    ];
}
