<?php

namespace App\Listeners;

use App\Events\FollowRequested;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFollowRequestNotification
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
    public function handle(FollowRequested $event): void
    {
        Notification::create([
            'user_id' => $event->recipient->id,
            'sender_id' => $event->sender->id,
            'post_id' => null,
            'type' => 'follow_request',
        ]);
    }
}
