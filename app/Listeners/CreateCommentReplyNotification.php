<?php

namespace App\Listeners;

use App\Events\CommentReplied;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCommentReplyNotification
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
    public function handle(CommentReplied $event): void
    {
        Notification::create([
            'user_id' => $event->recipient->id,
            'sender_id' => $event->sender->id,
            'post_id' => $event->post->id,
            'type' => 'comment_reply',
        ]);
    }
}
