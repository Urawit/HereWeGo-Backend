<?php

namespace App\Http\Controllers\Api;

use App\Events\SendPrivateChat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\PrivateChat;
use App\Models\Friend;
use App\Models\Activity;
use App\Models\ActivityMember;
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
      
      $private = Friend::select('friends.id', 'users.image_path', 'friends.friend_id', 'users.username as name')
      ->addSelect(DB::raw('
          CASE
            WHEN private_chats.message IS NOT NULL THEN private_chats.message
            ELSE (
                SELECT p.message
                FROM private_chats as p
                WHERE p.friend_id = (SELECT id FROM friends fs WHERE fs.user_id = friends.friend_id AND fs.friend_id = friends.user_id LIMIT 1)
                ORDER BY p.created_at DESC
                LIMIT 1
            )
          END as message
      '))
      ->addSelect(DB::raw('
          CASE
              WHEN private_chats.created_at IS NOT NULL THEN private_chats.created_at
              ELSE (
                SELECT p.created_at
                FROM private_chats as p
                WHERE p.friend_id = (SELECT id FROM friends fs WHERE fs.user_id = friends.friend_id AND fs.friend_id = friends.user_id LIMIT 1)
                ORDER BY p.created_at DESC
                LIMIT 1
              )
          END as created_at
      '))
      ->join('users', 'friends.friend_id', '=', 'users.id')
      ->leftJoin('private_chats', function ($join) {
        $join->on('friends.id', '=', 'private_chats.friend_id')
        ->where('private_chats.created_at', function ($query) {
            $query->select(DB::raw('MAX(private_chats.created_at)'))
                ->from('private_chats');
        });
      })
      ->whereIn('friends.friend_id', function ($query) use ($user_id) {
          $query->select('user_id')
              ->from('friends')
              ->where('friend_id', $user_id);
      })
      ->where('friends.user_id', $user_id)
      ->orderBy('created_at', 'desc') // Order by the new created_at field
      ->get();
  

      $group = DB::table('activity_members as am')
      ->select('am.activity_id as id', 'at.post_image_path as image_path', 'at.name')
      ->addSelect(DB::raw('
          CASE
            WHEN ac.message IS NOT NULL THEN ac.message
            ELSE (
                SELECT message
                FROM activity_chats
                WHERE activity_id = at.id
                ORDER BY created_at DESC
                LIMIT 1
            )
          END as message
      '))
      ->addSelect(DB::raw('
          CASE
              WHEN ac.created_at IS NOT NULL THEN ac.created_at
              ELSE (
                SELECT created_at
                FROM activity_chats
                WHERE activity_id = at.id
                ORDER BY created_at DESC
                LIMIT 1
              )
          END as created_at
      '))
      ->join('activities as at', 'at.id', '=', 'am.activity_id')
      ->leftJoin('activity_chats as ac', function ($join) use ($user_id) {
          $join->on('ac.activity_id', '=', 'am.activity_id')
              ->where('ac.created_at', function ($query) use ($user_id) {
                  $query->select(DB::raw('MAX(ac.created_at)'))
                      ->from('activity_members as am')
                      ->where('am.user_id', $user_id)
                      ->whereColumn('am.activity_id', 'ac.activity_id');
              });
      })
      ->where('am.user_id', $user_id)
      ->orderBy('ac.created_at')
      ->get();

      $private = Friend::hydrate($private->toArray());
      $group = ActivityMember::hydrate($group->toArray());
      $results = $private->merge($group)->sortByDesc('created_at');
      $results = $results->values()->all();

     return response()->json([
       "chats" => $results,
       "result" => true
     ]);
   }

   public function getName(Request $request)
   {
     $type = $request->get('type');
     $id = $request->get('id');
   
     if ($type == 'friend') {
       return User::where('id', $id)->first();
     } elseif ($type == 'activity') {
       return Activity::where('id', $id)->first();
     }
   
     return false;
   }
}
