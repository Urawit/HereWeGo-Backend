<?php

namespace App\Http\Controllers\Api;

use App\Events\SendNotification;
use App\Events\SendPrivateChat;
use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\PrivateChat;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
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
         "message" => "ID {$friend->id} not your friend.",
         "result" => false
       ]);
     };

     $message = new PrivateChat();
     $message->friend_id = $isFriend->id;
     $message->user_id = $user->id;
     $message->message = $messageText;
     $message->save();

     broadcast(new SendPrivateChat($message, $friend))->toOthers();
     broadcast(new SendNotification($friend->id, "Message"))->toOthers();
   
     return ['status' => 'Message Sent!'];
  }
}
