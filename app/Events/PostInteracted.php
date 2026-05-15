<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostInteracted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recipient; // LOCAL: Dueño del post
    public $sender; // LOCAL: Quien interactúa
    public $post;   // LOCAL: El post

    /**
     * Create a new event instance.
     */
    public function __construct($recipient,$sender,$post)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
