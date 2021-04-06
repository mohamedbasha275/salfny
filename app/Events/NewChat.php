<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // define my variables
    public $sender_id;
    public $receiver_id;
    public $message;
    public $sender_img;
    public $sender_name;
    public $time;
    public function __construct($data=[])
    {
        // get data
        $this->sender_id = $data['sender_id'];
        $this->receiver_id = $data['receiver_id'];
        $this->message = $data['message'];
        $this->sender_img = $data['sender_img'];
        $this->sender_name = $data['sender_name'];
        $this->time = $data['time'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return ['new-chat'];
    }
}
