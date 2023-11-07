<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'Users retrieved successfully',
            'users' => $users
        ]);
    }

    public function getUserImage()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'User image retrieved successfully',
            'image_path' => $user->image_path,
        ]);
    }
    
    public function editUser(Request $request)
    {
        $request->validate([
            "username" => "unique:users",
            "email" => "email|unique:users",
            "password" => "confirmed",
            "image" => "max:1024",
        ]);
        if (User::where('email', $request->get('email'))->exists()) {
            return ['message' => 'Email already exists', 'success' => false];
        }

        $user = User::where('id', auth()->user()->id)->first();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $user->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $fileName);
            $user->image_path = 'avatars/' . $fileName;
        }

        $user->username = $request->input('username') ? $request->input('username') : $user->username;
        $user->firstname = $request->filled('firstname') ? $request->input('firstname') : $user->firstname;
        $user->lastname = $request->filled('lastname') ? $request->input('lastname') : $user->lastname;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->filled('phone') ? $request->input('phone') : $user->phone;
        $user->save();
        return response()->json([
            "status" => true,
            "message" => "User edited successfully",
            "user" => $user,
        ]);
    }

    public function myActivities()
    {
      $myActivities = Activity::where("user_id", "=", auth()->user()->id)->get();

      return response()->json($myActivities);
    }
    public function myJoinActivities()
    {
      $myJoinActivities = ActivityMember::join('activities', 'activities.id', '=', 'activity_members.activity_id')
      ->where("activity_members.user_id", auth()->user()->id)
      ->get(['activity_id', 'name', 'detail', 'maximum', 'post_image_path', 'start_date', 'end_date']);

      return response()->json($myJoinActivities);
    }

    public function getOnlineUser()
    {
        if (!auth()->check()) {
            return response()->json(['users' => []]);
        }
        $user = User::where('id', auth()->user()->id)->get();
        return response()->json(['users' => $user]);
    }

    public function findUserByID($user_id){
        $user = User::where('id', $user_id)->first();
        return $user;
    }

}