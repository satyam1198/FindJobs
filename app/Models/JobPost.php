<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $table = 'job_posts';
    
    protected $fillable = [
        'title', 
        'company', 
        'location', 
        'job_type',
        'salary_min', 
        'salary_max', 
        'description',
        'responsibilities', 
        'requirements', 
        'perks',
        'application_deadline', 
        'contact_email', 
        'website',
    ];
}
