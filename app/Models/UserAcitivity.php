<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAcitivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'masterActivity_id',
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
