<?php

namespace App\Http\Controllers\Api;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityMemberRequest;
use App\Http\Requests\UpdateActivityMemberRequest;
use App\Models\ActivityMember;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityMemberController extends Controller
{
    public function joinActivity($id)
    {
        $user_id = auth()->user()->id;

        // Check if the user is already a member of the activity
        $existingMember = ActivityMember::where('user_id', $user_id)->where('activity_id', $id)->first();

        if (!$existingMember) {
            $activityMember = new ActivityMember();
            $activityMember->user_id = $user_id;
            $activityMember->activity_id = $id;
            $activityMember->save();

            $notification = new Notification();
            $notification->link_id = $id;
            $notification->user_id = $user_id;
            $notification->header = "Join Activity";
            $notification->detail = "You have joined the activity.";
            $notification->save();

            broadcast(new SendNotification($user_id, "Notification"))->toOthers();

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

    public function unjoinActivity($id)
    {
        $user_id = auth()->user()->id;

        $existingMember = ActivityMember::where('user_id', $user_id)->where('activity_id', $id)->first();

        if ($existingMember) {
            $existingMember->delete();

            $notification = new Notification();
            $notification->link_id = $id;
            $notification->user_id = $user_id;
            $notification->header = "Unjoin Activity";
            $notification->detail = "You have left the activity.";
            $notification->save();

            broadcast(new SendNotification($user_id, "Notification"))->toOthers();

            return response()->json([
                'message' => 'You have left the activity successfully',
                'success' => true,
            ]);
        }
        return response()->json([
            'message' => 'You were not a member of the activity',
            'success' => false,
        ]);
    }

    public function isMember($id)
    {
        $user_id = auth()->user()->id;
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

    public function getAllMember($activity_id)
    {
        $users = ActivityMember::where('activity_id', $activity_id)->with('user')->get();
        return $users->pluck('user');
    }

    // chat
    // used in messaage.page to display group that you are in -> just to chat
    // also show all atribute of the member
    // public function showMemberActivity()
    // {

    //     $activities = ActivityMember::join('activities','activity_members.activity_id', '=', 'activities.id')
    //     ->where('activity_members.user_id',auth()->user()->id)
    //     ->select('activities.*')
    //     ->get(); 

    //     return response()->json([
    //         'activities' => $activities,
    //     ]);
    // }

    public function showMemberActivity()
    {
        $activities = ActivityMember::join('activities', 'activity_members.activity_id', '=', 'activities.id')
            ->where('activity_members.user_id', auth()->user()->id)
            ->select('activities.*')
            ->get(); 

        $activityIds = $activities->pluck('id');

        $allMembers = collect();
        foreach ($activityIds as $activityId) {
            $users = ActivityMember::where('activity_id', $activityId)->with('user')->get();
            foreach ($users as $user) {
                $allMembers->push($user->user); // Extracting only the 'user' information
            }
        }

        return response()->json([
            'activities' => $activities,
            'allMembers' => $allMembers,
        ]);
    }



}