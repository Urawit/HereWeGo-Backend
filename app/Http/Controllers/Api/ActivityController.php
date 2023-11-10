<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\ActivityMember;
// use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createActivity(Request $request)
    {
        $request->validate([
            "name" => "unique:activities",
            "image" => "required|max:1024",
        ]);
        // $user = Auth::user();
        // $user_id = $user->id;
        $user_id = $request->input('user_id');
        $activity = new Activity();
        $activity->user_id = $user_id;
        $activity->master_activity_id = $request->input('master_activity_id');
        $activity->name = $request->input('name'); 
        $activity->detail = $request->input('detail');
        $activity->goal = $request->input('goal'); 
        $activity->location = $request->input('location');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $request->input('name') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('posts'), $fileName);
            $activity->post_image_path = 'posts/' . $fileName;
        }

        $activity->maximum = $request->input('maximum'); 
        $activity->start_date = $request->input('start_date'); 
        $activity->end_date = $request->input('end_date'); 
        $activity->save();

        $activityMember = new ActivityMember();
        $activityMember->user_id = $request->input('user_id');
        $activityMember->activity_id = $activity->id;
        $activityMember->save();

        return response()->json([
            'message' => 'activitiy created successfully',
            'success' => true,
            'activity' => $activity,
            'activityMember' => $activityMember,
        ]);
    }

    public function editActivity(Request $request, $id)
    {
        $activity = Activity::find($id);

        $rules = [
            'name' => 'unique:activities,name,' . $activity->id,
        ];
        $request->validate($rules);

        if ($request->hasFile('post_image')) {
            $file = $request->file('post_image');
            $fileName = $request->input('name') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('posts'), $fileName);
            $activity->post_image_path = 'posts/' . $fileName;
        }
        #goal location
        $activity->name = $request->input('name');
        $activity->detail = $request->input('detail');
        $activity->master_activity_id = $request->input('master_activity_id');
        $activity->maximum = $request->input('maximum');
        $activity->start_date = $request->input('start_date');
        $activity->goal = $request->input('goal');
        $activity->location = $request->input('location');
        $activity->end_date = $request->input('end_date');
        $activity->save();

        $activityMember = ActivityMember::where('activity_id', $activity->id)->get();
        foreach ($activityMember as $member) {
            $notification = new Notification();
            $notification->link_id = $activity->id;
            $notification->user_id = $member->user_id;
            $notification->header = "Edit Activity";
            $notification->detail = "The activity has been updated.";
            $notification->save();
        }
        return response()->json([
            "status" => true,
            "message" => "Activity edited successfully",
            "user" => $activity,
        ]);
    }

    public function getActivity($id)
    {
        $activity = Activity::with('likes','comments.user','favorites','activityMembers')->find($id);
        if (!$activity) {
            return response()->json([
                'message' => 'Activity not found',
                'success' => false,
            ], 404);
        }
        return response()->json([
            'message' => 'Activity retrieved successfully',
            'success' => true,
            'activity' => $activity
        ]);
    }


    public function getAllActivities()
    {
        $activities = Activity::with('likes','comments','favorites','activityMembers')->get();

        return response()->json([
            'message' => 'All activities retrieved successfully',
            'success' => true,
            'activities' => $activities
        ]);
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->json([
                'message' => 'Activity not found',
                'success' => false,
            ], 404);
        }
        $activity->delete();
        return response()->json([
            'message' => 'Activity deleted successfully',
            'success' => true,
        ]);
    }
    public function getActiveActivities()
    {
        $activities = Activity::where('start_date', '>', now())
            ->with('likes', 'comments', 'favorites', 'activityMembers')
            ->leftJoin('master_activities', 'activities.master_activity_id', '=', 'master_activities.id')
            ->select('activities.*', 'master_activities.name AS master_name')
            ->orderBy('start_date')->get();
        // $masterActivities = MasterActivity::where("id", $activities->master_activities_id);

        return response()->json([
            'message' => 'All activities retrieved successfully',
            'success' => true,
            'activities' => $activities,
        ]);
    }
}