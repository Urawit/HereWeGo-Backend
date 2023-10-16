<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'create_date',
        'delete_date'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->belongsTo(Activity::class);
    }

}
