<?php

namespace App\Listeners;

use App\Events\ChatRequested;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateChatRequestNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChatRequested $event): void
    {
        Notification::create([
            'user_id' => $event->recipient->id,
            'sender_id' => $event->sender->id,
            'post_id' => null,
            'type' => 'chat_request',
        ]);
    }
}
