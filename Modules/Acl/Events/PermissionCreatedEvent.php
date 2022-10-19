<?php

namespace Modules\Acl\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PermissionCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Permission instance.
     *
     * @var Permission
     */
    public $permission;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
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
