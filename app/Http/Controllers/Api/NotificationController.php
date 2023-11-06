<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function myNotification()
    {
      //$notifications = Notification::where('user_id', Auth::user()->id)->orderBy("created_at","desc")->get();
      $notifications = Notification::where('user_id', auth()->user()->id)
      ->orderBy("created_at","desc")
      ->get(['id', 'header', 'detail', 'created_at']);

      return response()->json($notifications);
    }
}
