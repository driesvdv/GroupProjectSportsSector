<?php

namespace App\Events;

use App\Models\Group;
use App\Models\Registration;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistrationAdded implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $afterCommit = true;

    /**
     * The registration instance
     *
     * @var \App\Models\Group
     */
    public Group $group;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Group $group
     */
    public function __construct(Registration $registration)
    {
        $this->group = Group::where('registration_id', $registration)->withcount('registrations')->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('groups.' . $this->group->id);
    }
}
