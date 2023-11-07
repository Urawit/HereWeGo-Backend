<?php

namespace App\Http\Controllers\Api;

use App\Events\SendPrivateChat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\PrivateChat;
use App\Models\Friend;



class ChatController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


   public function fetchMessages(Request $request)
   {
    $user_id = auth()->user()->id;
    $friend_id = $request->input('friend_id');
    $isFriend = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
    
    if (!$isFriend) {
      return response()->json([
        "message" => "ID {$friend_id} not your friend.",
        "result" => false
      ]);
    }
  
    $result = PrivateChat::whereIn('friend_id', function($query) use ($user_id, $friend_id) {
      $query->select('id')
        ->from('friends')
        ->where(function ($subquery) use ($user_id, $friend_id) {
          $subquery->where('user_id', $user_id)
            ->where('friend_id', $friend_id);
        })
        ->orWhere(function ($subquery) use ($user_id, $friend_id) {
          $subquery->where('user_id', $friend_id)
            ->where('friend_id', $user_id);
        });
    })->get();

    return response()->json([
      "chats" => $result,
      "result" => true
    ]);
   }
   

   public function messageStore(Request $request)
   {
      $user = auth()->user();
      $friend = User::where('id', $request->input('friend_id'))->first();
      $messageText = $request->input('message');

      $isFriend = Friend::where('user_id', $user->id)
        ->where('friend_id', $friend->id)
        ->first();
      if (!$isFriend) {
        return response()->json([
          "message" => "ID {$friend_id} not your friend.",
          "result" => false
        ]);
      };

      $message = new PrivateChat();
      $message->friend_id = $isFriend->id;
      $message->user_id = $user->id;
      $message->message = $messageText;
      $message->save();

      broadcast(new SendPrivateChat($message))->toOthers();
    
      return ['status' => 'Message Sent!'];
   }
}
