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
        $user = Auth::user();
        $user_id = $user->id;
        $activity = new Activity();
        $activity->user_id = $user_id;
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
        $activity->create_date = now(); 
        $activity->delete_date = null; 
        $activity->save();
        return response()->json([
            'message' => 'activitiy created successfully',
            'success' => true,
            'activity' => $activity
        ]);
    }

    public function editActivity(Request $request, $id)
    {
        $activity = Activity::find($id);
        $request->validate([
            "name" => "unique:activities",
        ]);

        if ($request->hasFile('post_image')) {
            $file = $request->file('post_image');
            $fileName = $request->input('name') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('posts'), $fileName);
            $activity->post_image_path = 'posts/' . $fileName;
        }
        #goal location
        $activity->name = $request->input('name') ? $request->input('name') : $activity->name; 
        $activity->detail = $request->input('detail') ? $request->input('datail') : $activity->detail ;
        $activity->maximum = $request->input('maximum')? $request->input('maximum') : $activity->maximum;
        $activity->start_date = $request->input('start_date')? $request->input('start_date') : $activity->start_date; 
        $activity->goal = $request->input('goal') ? $request->input('goal') : $activity->goal;
        $activity->location = $request->input('location') ? $request->input('location') : $activity->location;
        $activity->end_date = $request->input('end_date')? $request->input('end_date') : $activity->end_date;  
        $activity->save();

        $activityMember = ActivityMember::where('activity_id', $activity->id)->get();
        foreach ($activityMember as $member) {
          $notification = new Notification();
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
        $activity = Activity::find($id);
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
        $activities = Activity::all();

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
        $activities = Activity::where('start_date', '>', now())->orderBy('start_date')->get();

        return response()->json([
            'message' => 'All activities retrieved successfully',
            'success' => true,
            'activities' => $activities
        ]);
    }
}
