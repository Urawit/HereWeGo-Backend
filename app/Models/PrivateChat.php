<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'friend_id',
        'user_id',
        'chat_room_id',
        'message',
        'create_date',
        'delete_date'
    ];

    public function friends()
    {
        return $this->belongsTo(User::class, 'friends_id');
    }

    // public function room()
    // {
    //     return $this->hasOne(ChatRoom::class, 'id', 'chat_room_id');
    // }
    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }
}
