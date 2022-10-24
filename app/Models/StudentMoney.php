<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMoney extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'value',
        'date'
    ];

}
