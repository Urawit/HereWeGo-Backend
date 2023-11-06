<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Events\MessageSent;
use App\Models\Message;
use Tymon\JWTAuth\Contracts\Providers\Auth;

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

   public function sendMessage(Request $request)
   {
       $user = FacadesAuth::user();
       $message = $user->messages()->create([
           'message' => $request->input('message')
       ]);
       broadcast(new MessageSent($user, $message))->toOthers();
       return ['status' => 'Message Sent!'];
   }
}