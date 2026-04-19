<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enrollee extends Model
{
    protected $fillable = [
        'student_id', 'name', 'course', 'year', 'block',
    ];
}