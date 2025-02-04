<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use \app\Models\Lead;
use App\Models\Workflows;

class StatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $lead,$workflow;
    /**
     * Create a new event instance.
     */
    public function __construct(Lead $lead,Workflows $workflow)
    {
        $this->lead=$lead;
        $this->workflow=$workflow;

    }

   
}
