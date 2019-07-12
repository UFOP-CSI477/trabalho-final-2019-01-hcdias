<?php

namespace PesquisaProjeto\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MestradoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mestrado;
    public $eventType;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mestrado,$eventType)
    {
        $this->mestrado = $mestrado;
        $this->eventType = $eventType;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
