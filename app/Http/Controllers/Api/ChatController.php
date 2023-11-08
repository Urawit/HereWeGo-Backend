<?php

namespace App\Http\Controllers\Api;

use App\Events\SendPrivateChat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\PrivateChat;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

   public function chatAll()
   {
     $user_id = auth()->user()->id;

     $private = Friend::select('friends.id', 'friends.friend_id', 'users.username as name', 'private_chats.message', 'private_chats.created_at')
     ->join('users', 'friends.friend_id', '=', 'users.id')
     ->join('private_chats', 'friends.id', '=', 'private_chats.friend_id')
     ->whereIn('friends.friend_id', function ($query) use ($user_id) {
         $query->select('user_id')
             ->from('friends')
             ->where('friend_id', $user_id);
     })
     ->where('friends.user_id', $user_id)
     ->whereIn(DB::raw('(friends.id, private_chats.created_at)'), function ($query) use ($user_id) {
         $query->select('friends.id', DB::raw('MAX(private_chats.created_at)'))
             ->from('friends')
             ->join('private_chats', 'friends.id', '=', 'private_chats.friend_id')
             ->whereIn('friends.friend_id', function ($subquery) use ($user_id) {
                 $subquery->select('user_id')
                     ->from('friends')
                     ->where('friend_id', $user_id);
             })
             ->where('friends.user_id', $user_id)
             ->groupBy('friends.id');
     })
     ->orderBy('private_chats.created_at', 'desc')
     ->get();

     $group = DB::table('activity_members as am')
     ->select('am.activity_id as id', 'at.name', 'ac.message', 'ac.created_at')
     ->join('activity_chats as ac', 'ac.activity_id', '=', 'am.activity_id')
     ->join('activities as at', 'at.id', '=', 'am.activity_id')
     ->where('am.user_id', $user_id)
     ->whereIn(DB::raw('(am.activity_id, ac.created_at)'), function ($query) use ($user_id) {
         $query->select('am.activity_id', DB::raw('MAX(ac.created_at)'))
             ->from('activity_members as am')
             ->join('activity_chats as ac', 'ac.activity_id', '=', 'am.activity_id')
             ->where('am.user_id', $user_id)
             ->groupBy('am.activity_id');
     })
     ->orderBy('ac.created_at', 'desc')
     ->get();

      $results = $private->union($group)->sortByDesc('created_at');

     return response()->json([
       "chats" => $results,
       "result" => true
     ]);
   }


}
