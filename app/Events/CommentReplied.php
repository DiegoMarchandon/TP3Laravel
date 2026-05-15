<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentReplied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recipient; // LOCAL: Quien recibe la notificación
    public $sender;     // LOCAL: Quien envía (responde)
    public $post;    // LOCAL: El post del que surgió el comentario

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
