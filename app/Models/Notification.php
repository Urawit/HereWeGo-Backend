<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'header',
        'detail',
        'create_date',
        'delete_date'
    ];

    public function activities()
    {
        return $this->belongsTo(Activity::class);
    }
}
