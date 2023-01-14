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

    public function groupTeacher(){
        return $this->hasMany(GroupTeacher::class, 'group_id', 'id');
    }

    public function groupPrice(){
        return $this->hasMany(GroupPrice::class, 'group_id', 'id');
    }
}
