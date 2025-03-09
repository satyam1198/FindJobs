<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_applications';  
    protected $fillable = [
        'applied_by',
        'job_id',
        'status',
        'resume',
        'cover_letter',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'id');
    }
}
