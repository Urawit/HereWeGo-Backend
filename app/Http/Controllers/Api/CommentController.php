<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // no need to check for duplicate comment
    // cause you can comment on the same post same comment
    public function comment(Request $request) {
        $request->validate([
            'activity_id' => 'required',
            'comment' => 'required'
        ]);
        
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->activity_id = $request->activity_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ]);
    }
   
    public function deleteComment(Request $request) {
        $request->validate([
            'comment_id' => 'required',
            'activity_id' => 'required',
        ]);
    
        $comment = Comment::where('id', $request->comment_id)
            ->where('activity_id', $request->activity_id)
            ->first();

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found for the specified activity'
            ], 404);
        }

        $user_id = auth()->user()->id;
        if ($comment->user_id != $user_id) {
            return response()->json([
                'message' => 'Unauthorized. You can only delete your own comment'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);

    }

    public function editComment(Request $request) {
    
        $comment = Comment::where('id', $request->comment_id)
            ->where('activity_id', $request->activity_id)
            ->first();
    
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found for the specified activity'
            ], 404);
        }
    
        $user_id = auth()->user()->id;
        if ($comment->user_id != $user_id) {
            return response()->json([
                'message' => 'Unauthorized. You can only edit your own comment'
            ], 403);
        }
    
        $comment->comment = $request->comment ?? $comment->comment; 
        $comment->save();
    
        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => $comment
        ]);
    }
}
