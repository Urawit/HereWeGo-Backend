<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\SendMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;

class ChatController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


   public function fetchMessages()
   {
       return Message::with('user')->get();
   }

   public function messageStore(Request $request)
   {
       $user = Auth::user();
       $message = $user->messages()->create([
           'message' => $request->input('message')
       ]);
       broadcast(new SendMessage($user, $message))->toOthers();
       return ['status' => 'Message Sent!'];
   }
}
