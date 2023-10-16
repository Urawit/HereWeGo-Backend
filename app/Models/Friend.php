<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'friend_id',
        'user_id',
        'create_date',
        'delete_date'
    ];


    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
