<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'student_id',
        'group_lesson_id',
        'attend',
        'active',
        'payed',
        'comment',
        'month',
        'year',
        'date',
    ];
}
