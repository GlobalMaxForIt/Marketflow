<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostNotification implements ShouldBroadcast
{

    public $message;
    public $users_id;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $users_id)
    {
        $this->message = $message;
        $this->users_id = $users_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [new Channel('post-order')];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'users_id' => $this->users_id,
        ];
    }
    public function broadcastAs()
    {
        return 'post-event';
    }
}
