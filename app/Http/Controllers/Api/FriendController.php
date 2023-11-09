<?php

namespace App\Http\Controllers\Api;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendController extends Controller
{
    public function addFriend(Request $request)
    {
      $request->validate([
        'friend_id' => ['required']
      ]);
      $user_id = auth()->user()->id;
      $friend_id = $request->get("friend_id");

      $exist = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
      if ($exist) {
        return response()->json([
          "message" => "ID {$friend_id} has been add.",
          "result" => false
        ]);
      };
      if ($user_id == $friend_id) {
        return response()->json([
          "message" => "Unable to add myself as a friend",
          "result" => false
        ]);
      };

      $sender_username = User::where('id', $user_id)->value('username');
      $receiver_username = User::where('id', $friend_id)->value('username');
      
      $friend = new Friend();
      $friend->user_id = $user_id;
      $friend->friend_id = $friend_id;
      $friend->save();

      $havefriend = Friend::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
      if ($havefriend) {
        $notification = new Notification();
        $notification->user_id = $user_id;
        $notification->header = "Friend Request";
        $notification->detail = "{$receiver_username} is your friend.";
        $notification->save();
        broadcast(new SendNotification($user_id, "Notification"))->toOthers();
        
        $notification = new Notification();
        $notification->user_id = $friend_id;
        $notification->header = "Friend Request";
        $notification->detail = "{$sender_username} is your friend.";
        $notification->save();
        broadcast(new SendNotification($friend_id, "Notification"))->toOthers();
      } else {
        $notification = new Notification();
        $notification->user_id = $user_id;
        $notification->header = "Friend Request";
        $notification->detail = "{$receiver_username} have received a friend request.";
        $notification->save();
        broadcast(new SendNotification($user_id, "Notification"))->toOthers();

        $notification = new Notification();
        $notification->user_id = $friend_id;
        $notification->header = "Friend Request";
        $notification->detail = "{$sender_username} have sent you a friend request";
        $notification->save();
        broadcast(new SendNotification($friend_id, "Notification"))->toOthers();
      }

      return response()->json([
        "message" => "Add Friend Success",
        "result" => true
      ]);
    }
    public function statusFriend(Request $request)
    {
      $request->validate([
        'friend_id' => ['required']
      ]);
      $user_id = auth()->user()->id;
      $friend_id = $request->get("friend_id");

      $user = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
      $friend = Friend::where('user_id', $friend_id)->where('friend_id', $user_id)->first();

      if ($friend && $user) {
        return response()->json([
          "message" => "Friend.",
          "result" => "F"
        ]);
      } else if ($user) {
        return response()->json([
          "message" => "User Wating.",
          "result" => "UW"
        ]);
      } else if ($friend) {
        return response()->json([
          "message" => "Friend Wating.",
          "result" => "FW"
        ]);
      } else {
        return response()->json([
          "message" => "Not Friend.",
          "result" => "NF"
        ]);
      };
    }
    public function deleteFriend(Request $request)
    {
      $request->validate([
        'friend_id' => ['required']
      ]);
      $user_id = auth()->user()->id;
      $friend_id = $request->get("friend_id");

      $friend = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
      if ($friend) {
        $friend->delete();
      }

      $user = Friend::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
      if ($user) {
        $user->delete();
      }

      return response()->json([
        "message" => "Delete Friend Success",
        "result" => true
      ]);
    }
}
