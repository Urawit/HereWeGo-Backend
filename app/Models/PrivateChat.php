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
        'message',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'private_chat_id');
    }

    public function friends()
    {
        return $this->belongsTo(User::class, 'friends_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
