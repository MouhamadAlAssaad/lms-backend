<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'capacity'
    ];

    public function Course(){
        return $this->belongsTo(Course::class);
    }

}