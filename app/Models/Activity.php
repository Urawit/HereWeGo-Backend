<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'master_activity_id',
        'name',
        'detail',
        'goal',
        'maximum',
        'location',
        'post_image_path',
        'start_date',
        'end_date'
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}

