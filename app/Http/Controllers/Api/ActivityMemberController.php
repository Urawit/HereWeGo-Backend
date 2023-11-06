<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityMemberRequest;
use App\Http\Requests\UpdateActivityMemberRequest;
use App\Models\ActivityMember;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityMemberController extends Controller
{
    // public function joinActivity($id)
    // {
    //     $user_id = Auth::id();

    //     $activityMember = new ActivityMember();
    //     $activityMember->user_id = $user_id;
    //     $activityMember->activity_id = $id;
    //     $activityMember->save();

    //     $notification = new Notification();
    //     $notification->user_id = $user_id;
    //     $notification->header = "Join Activity";
    //     $notification->detail = "You have joined activity.";
    //     $notification->save();

    //     return response()->json([
    //         'message' => 'You have joined the activity successfully',
    //         'success' => true,
    //         'activity_member' => $activityMember
    //     ]);
    // }

    public function joinActivity($id)
    {
        $user_id = Auth::id();

        // Check if the user is already a member of the activity
        $existingMember = ActivityMember::where('user_id', $user_id)->where('activity_id', $id)->first();

        if (!$existingMember) {
            $activityMember = new ActivityMember();
            $activityMember->user_id = $user_id;
            $activityMember->activity_id = $id;
            $activityMember->save();

            $notification = new Notification();
            $notification->user_id = $user_id;
            $notification->header = "Join Activity";
            $notification->detail = "You have joined the activity.";
            $notification->save();

            return response()->json([
                'message' => 'You have joined the activity successfully',
                'success' => true,
                'activity_member' => $activityMember
            ]);
        }
        return response()->json([
            'message' => 'You can not join',
            'success' => false,

        ]);
    }

    public function isMember($id)
    {
        $user_id = Auth::id();
        $existingMember = ActivityMember::where('user_id', $user_id)->where('activity_id', $id)->first();

        if ($existingMember) {

            return response()->json([
                'message' => 'You are member',
                'success' => true,
            ]);
        }
        return response()->json([
            'message' => 'You are not member',
            'success' => false,
        ]);
    }

    public function getAllMember($activity_id){
        $user = ActivityMember::where('activity_id', $activity_id)->get();
        return $user;
    }
}
