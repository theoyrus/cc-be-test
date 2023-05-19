<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateCustomerWalletJobDone
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $message;

    /**
     * Create a new event instance.
     * @param  string  $status
     * @param  string  $message
     */
    public function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
        Log::info('job done');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('wallet-balance'),
        ];
    }
}
