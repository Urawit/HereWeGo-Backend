<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class MasterActivityController extends Controller
{
    public function allActivities()
    {
      $activities = MasterActivity::all();

      return response()->json($activities);
    }
    public function selectActivities(Request $request)
    {
      $request->validate([
        'user_id' => ['required']
      ]);
      $user_id = $request->input('user_id');
      $subquery = UserActivity::where('user_id', $user_id)->get('master_activity_id');
      $activities = MasterActivity::whereNotIn('id', $subquery)->get();
  
      return response()->json($activities);
    }
}
