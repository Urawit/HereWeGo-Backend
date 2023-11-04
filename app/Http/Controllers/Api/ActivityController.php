<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
// use App\Models\User;
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
        $user = Auth::user();
        $user_id = $user->id;
        $activity = new Activity();
        $activity->user_id = $user_id;
        $activity->name = $request->input('name'); 
        $activity->detail = $request->input('detail'); 
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
