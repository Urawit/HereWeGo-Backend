<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request) 
    {
        $request->validate([
            "username" => "required|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);
        if (User::where('email', $request->get('email'))->exists()) {
            return ['message' => 'Email already exists', 'success' => false];
        }

        $user = new User();
        $user->username = $request->get('username');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->password); // Hash the password
        $user->phone = $request->get('phone');
        $user->save();

        $token = Auth::login($user);

        return response()->json([
            "status" => true,
            "message" => "User created successfully",
            "user" => $user,
            "token" => $token
        ]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}