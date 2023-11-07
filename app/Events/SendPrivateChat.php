<?php

namespace App\Events;

use App\Models\PrivateChat;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendPrivateChat implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;

  public function __construct(PrivateChat $message)
  {
      $this->message = $message;
  }


  public function broadcastOn()
  {
    return 'Private';
  }

  public function broadcastAs()
  {
    return 'Message';
  }
}
