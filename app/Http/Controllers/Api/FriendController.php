<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreFriendRequest;
use App\Http\Requests\UpdateFriendRequest;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function showFriend()
    {
      //$friends = Friend::all()->where("user_id", 1);
      $friends = Friend::all()->where("user_id", Auth::user()->id);
      return response()->json([
        "friends" => $friends,
        "result" => true
      ]);
    }
    public function addFriend(Request $request)
    {
      $request->validate([
        'id' => ['required']
      ]);
      //$user_id = 1;
      $user_id = Auth::user()->id;
      $friend_id = $request->get("id");
      $exist = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
      if ($exist) {
        return response()->json([
          "message" => "ID {$friend_id} has been friend.",
          "result" => false
        ]);
      };

      if ($user_id == $friend_id) {
        return response()->json([
          "message" => "Unable to add myself as a friend",
          "result" => false
        ]);
      };
        
      $friend = new Friend();
      $friend->user_id = $user_id;
      $friend->friend_id = $friend_id;
      $friend->save();
      return response()->json([
        "message" => "Add Friend Success",
        "result" => true
      ]);
    }
    public function deleteFriend(Request $request)
    {
      $request->validate([
        'id' => ['required']
      ]);
      //$user_id = 1;
      $user_id = Auth::user()->id;
      $friend_id = $request->get("id");
      $friend = Friend::where('user_id', $user_id)->where('friend_id', $friend_id)->first();

      if (!$friend) {
        return response()->json([
        "message" => "No friends with ID {$friend_id}.",
        "result" => false
        ], 400);
      }

      $friend->delete();
      return response()->json([
        "message" => "Delete Friend Success",
        "result" => true
      ]);
    }
}
