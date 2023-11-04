<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $user = Auth::user();

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

}