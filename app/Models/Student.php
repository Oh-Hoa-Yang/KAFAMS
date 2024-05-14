<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'stdName',
        'motherIC',
        'fatherIC',
        'stdIC',
        'stdBirthCert',
        'status',
    ];

    public function student(): BelongsTo
    {
      return $this->belongsTo(student::class);
    }
}
