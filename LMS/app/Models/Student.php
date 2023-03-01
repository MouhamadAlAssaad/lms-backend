<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'picture',
        'course_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}