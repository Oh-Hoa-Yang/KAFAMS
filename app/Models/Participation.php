<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'student_id',
    ];
    
    public function student() //Foreign key
    {
        return $this->belongsTo(Student::class);
    }

    public function activity() //Foreign key
    {
        return $this->belongsTo(Activity::class);
    }
}
