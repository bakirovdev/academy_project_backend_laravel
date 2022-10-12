<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_id',
        'active',
        'end'
    ];

    public function course(){
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
