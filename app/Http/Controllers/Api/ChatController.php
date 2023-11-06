<?php

namespace App\Http\Controllers\Api;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


   public function fetchMessages()
   {
      $user = auth()->user()->id;
      return Message::where('user_id', $user)
      ->orderBy("created_at","desc")
      ->get();
   }

   public function messageStore(Request $request)
   {
      $user = auth()->user();
      $friend = User::where('id', $request->input('friend_id'))->first();
      $messageText = $request->input('message');

      $message = new Message();
      $message->user_id = $user->id;
      $message->message = $messageText;
      $message->save();

      broadcast(new SendMessage($friend, $message))->toOthers();
    
      return ['status' => 'Message Sent!'];
   }
}
