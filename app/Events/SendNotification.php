<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendNotification implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $id;
  public $type;

  public function __construct($id, $type)
  {
      $this->id = $id;
      $this->type = $type;
  }


  public function broadcastOn()
  {
    return 'Notifications';
  }

  public function broadcastAs()
  {
    return $this->type . $this->id;
  }
}
