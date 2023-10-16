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
        'message',
        'create_date',
        'delete_date'
    ];

    public function activities()
    {
        return $this->belongsTo(Activity::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
