<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function showUserActivities(Request $request)
    {
      $request->validate([
        'user_id' => ['required']
      ]);
      $user_id = $request->get("user_id");

      $userActivities = UserActivity::join('master_activities', 'user_activities.master_activity_id', '=', 'master_activities.id')
      ->where("user_id", $user_id)
      ->get(['master_activity_id', 'name']);

      return response()->json($userActivities);
    }
    public function addUserActivities(Request $request)
    {
      $request->validate([
        'user_id' => ['required'],
        'master_activity_id' => ['required']
      ]);
      $user_id = $request->get('user_id');
      $master_activity_id = $request->get('master_activity_id');

      $exist = UserActivity::where('user_id', $user_id)->where('master_activity_id', $master_activity_id)->first();
      if ($exist) {
        return response()->json([
          "message" => "ID {$master_activity_id} has been add.",
          "result" => false
        ]);
      };

      $userActivity = new UserActivity();
      $userActivity->user_id = $user_id;
      $userActivity->master_activity_id = $master_activity_id;
      $userActivity->save();

      return response()->json([
        "message"=> "Add Activity Success",
        "result" => true
      ]);
    }
    public function deleteUserActivities(Request $request)
    {
      $request->validate([
        'user_id' => ['required'],
        'master_activity_id' => ['required']
      ]);
      $user_id = $request->get('user_id');
      $master_activity_id = $request->get('master_activity_id');

      $userActivity = UserActivity::where('user_id', $user_id)->where('master_activity_id', $master_activity_id)->first();
      if (!$userActivity) {
        return response()->json([
          "message" => "No activity ID {$master_activity_id}.",
          "result" => false
        ]);
      };

      $userActivity->delete();

      return response()->json([
        "message"=> "Delete Activity Success",
        "result"=> true
      ]);
    }
}
