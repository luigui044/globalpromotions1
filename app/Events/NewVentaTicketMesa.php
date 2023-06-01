<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewVentaTicketMesa implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $evento, $localidad, $mesa, $asiento;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($evento, $localidad, $mesa, $asiento)
    {
        $this->evento = $evento;
        $this->localidad = $localidad;
        $this->mesa = $mesa;
        $this->asiento = $asiento;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("prerreservamesa.$this->evento.$this->localidad");
    }
}
