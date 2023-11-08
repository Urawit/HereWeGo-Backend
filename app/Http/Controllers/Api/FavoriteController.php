<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $request->validate([
            "activity_id" => "required"
        ]);

        $user_id = auth()->user()->id;
        $activity_id = $request->activity_id;

        $existingFavorite = Favorite::where('user_id', $user_id)->where('activity_id', $activity_id)->first();

        if ($existingFavorite) {
            return response()->json([
                "message" => "You have already favorited this activity",
                "result" => $existingFavorite
            ]);
        }
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->activity_id = $activity_id;
        $favorite->save();

        return response()->json([
            "message" => "Favorited successfully",
            "result" => $favorite
        ]);

    }

    public function unFavorite(Request $request)
    {
        $request->validate([
            "activity_id" => "required"
        ]);
        $user_id = auth()->user()->id;
        $activity_id = $request->activity_id;
 
        $favorite = Favorite::where('user_id', $user_id)->where('activity_id', $activity_id)->first();
    
        if ($favorite) {
            $favorite->delete();
            return response()->json([
                "message" => "Unfavorite successfully",
                "result" => true
            ]);
        } else {
            return response()->json([
                "message" => "favorite not found for this user and activity",
                "result" => false
            ]);
        }
    }
}
