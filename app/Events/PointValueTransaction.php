<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PointValueTransaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user ;
    public $scheme;
    public $orderTotal ;
    public $reference;
    public $redeem ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $scheme, $reference = '', $orderTotal = null , $redeem = null)
    {
        $this->user = $user;
        $this->scheme = $scheme;
        $this->orderTotal = $orderTotal;
        $this->reference = $reference;
        $this->redeem = $redeem;
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
