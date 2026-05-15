<?php

namespace App\Listeners;

use App\Events\PostInteracted;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePostInteractionNotification
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
    public function handle(PostInteracted $event): void
    {
        Notification::create([
            'user_id' => $event->recipient->id,
            'sender_id' => $event->sender->id,
            'post_id' => $event->post->id,
            'type' => 'post_interaction',
        ]);
    }
}
