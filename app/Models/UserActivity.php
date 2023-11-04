<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'master_activity_id',
        'create_date',
        'delete_date'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function masterActivities()
    {
        return $this->belongsTo(MasterActivity::class);
    }
}
