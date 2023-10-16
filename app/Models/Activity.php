<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'detail',
        'maximum',
        'start_date',
        'end_date',
        'create_date',
        'delete_date'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function activityChats()
    {
        return $this->hasMany(ActivityChat::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function activityMembers()
    {
        return $this->hasMany(ActivityMember::class);
    }

    public function masterActivities()
    {
        return $this->belongsTo(MasterActivity::class);
    }
}
