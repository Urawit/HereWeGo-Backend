<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $request->validate([
            "activity_id" => "required"
        ]);

        $user_id = auth()->user()->id;
        $activity_id = $request->activity_id;

        $existingLike = Like::where('user_id', $user_id)->where('activity_id', $activity_id)->first();

        if ($existingLike) {
            return response()->json([
                "message" => "You have already liked this activity",
                "result" => $existingLike
            ]);
        }
        $like = new Like();
        $like->user_id = $user_id;
        $like->activity_id = $activity_id;
        $like->save();

        return response()->json([
            "message" => "Liked successfully",
            "result" => $like
        ]);
    }
    
    public function unlike(Request $request)
    {
        $request->validate([
            "activity_id" => "required"
        ]);
        $user_id = auth()->user()->id;
        $activity_id = $request->activity_id;
 
        $like = Like::where('user_id', $user_id)->where('activity_id', $activity_id)->first();
    
        if ($like) {
            $like->delete();
            return response()->json([
                "message" => "Unliked successfully",
                "result" => true
            ]);
        } else {
            return response()->json([
                "message" => "Like not found for this user and activity",
                "result" => false
            ]);
        }
    }
}
