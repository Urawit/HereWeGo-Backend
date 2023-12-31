<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'user_id',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
