<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'user_id',
        'message'
    ];
    
    public function messages()
    {
        return $this->hasMany(Message::class, 'activity_chat_id');
    }

    public function activities()
    {
        return $this->belongsTo(Activity::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
