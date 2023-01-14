<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupDebit extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'student_id',
        'value',
        'bonus',
        'month',
        'year',
        'active'
    ];
}
