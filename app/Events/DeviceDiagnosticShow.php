<?php

namespace App\Events;

use App\Device;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeviceDiagnosticShow implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $device;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Device $device)
    {
        //
        $this->device = $device;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('DeviceDiagShow.'.$this->device->id);
    }
}
