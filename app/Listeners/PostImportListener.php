<?php

namespace App\Listeners;

use App\Entities\User;
use App\Events\PostImport;
use App\Notifications\PostImportNotification;

class PostImportListener
{
    public function handle(PostImport $event): void
    {
        /** @var User $user */
        $user = User::where(['admin' => true])->firstOrFail();

        $user->notify(new PostImportNotification($event->type, $event->result));
    }
}