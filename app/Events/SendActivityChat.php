<?php

namespace App\Events;

use App\Models\ActivityChat;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendActivityChat implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;
  public $activity;

  public function __construct(ActivityChat $message, $activity)
  {
      $this->message = $message;
      $this->activity = $activity;
  }

  public function broadcastOn()
  {
    return 'Group';
  }
  public function broadcastAs()
   {
    return 'Message' . $this->activity;
   }
}
