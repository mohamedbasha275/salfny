<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcast
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
    public $content;
    public $sender_img;
    public $sender_name;
    public $time;
    public $notf_id;
    public $notf_url;
    public function __construct($data=[])
    {
        // get data
        $this->sender_id = $data['sender_id'];
        $this->receiver_id = $data['receiver_id'];
        $this->content = $data['content'];
        $this->sender_img = $data['sender_img'];
        $this->sender_name = $data['sender_name'];
        $this->time = $data['time'];
        $this->notf_id = $data['notf_id'];
        $this->notf_url = $data['notf_url'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return ['new-notification'];
    }
}
