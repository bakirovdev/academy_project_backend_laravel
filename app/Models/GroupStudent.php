<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'student_id',
        'active',
        'bonus',
        'start_date',
        'end_date',
    ];

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function group(){
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
