<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostImportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $type;

    private $result;

    public function __construct(string $type, string $result)
    {
        $this->type = $type;
        $this->result = $result;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject($this->result === 'error' ? 'Error importing posts.' : 'Posts imported.')
            ->line($this->result === 'error' ? "An error occurred while importing messages from {$this->type}" :
                "{$this->type} posts imported successfully");
    }
}