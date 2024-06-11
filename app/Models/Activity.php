<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'activityName',
        'activityDetails',
        'location',
        'activityDate',
        'startTime',
        'endTime',
    ];

    public function participations() //One participation has many activities
    {
        return $this->hasMany(Participation::class, 'activity_id', 'id');
    }
}
