<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'friend_id',
        'message',
        'create_date',
        'delete_date'
    ];

    public function friends()
    {
        return $this->belongsTo(User::class, 'friends_id');
    }
}
