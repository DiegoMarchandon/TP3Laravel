<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $recipient; // LOCAL: Quien recibe la solicitud
    public $sender;     // LOCAL: Quien envía la solicitud

    /**
     * Create a new event instance.
     */
    public function __construct($recipient,$sender)
    {
        $this->recipient = $recipient;    
        $this->sender = $sender;
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
