<?php

namespace App\Http\Controllers\Api;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\PrivateChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
    public function message(Request $request)
    {
        $request->validate([
            "username" => "required",
            "message" => "required"
        ]);
        event(new Message($request->input('username'), $request->input('message')));
        return [];
    }
}


// public function getAllrooms() {
    //     return ChatRoom::all();
    // }
    // //class ChatMessage
    // public function getMessage($roomId){
    //     return PrivateChat::where('chat_room_id', $roomId)
    //     ->with('user')
    //     ->orderBy('created_at','DESC')
    //     ->get();
    // }
    // public function newMessage(Request $request, $roomID){
    //     $newMessage = new PrivateChat;
    //     $newMessage->user_id = Auth::id();
    //     $newMessage->chat_room_id = $roomID;
    //     $newMessage->message = $request->message;
    //     $newMessage->save();
    //     return $newMessage;
    // }
