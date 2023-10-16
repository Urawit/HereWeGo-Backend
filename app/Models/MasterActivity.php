<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'activity_id',
        'create_date',
        'delete_date'
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
