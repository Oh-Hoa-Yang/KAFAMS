<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;
    protected $fillable = [
        'bulletinCategory',
        'bulletinTitle',
        'bulletinMessage',
    ];

    /*public function participations()
    {
        return $this->hasMany(Participation::class, 'activity_id', 'id');
    }*/
}