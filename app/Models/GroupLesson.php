<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'start_time',
        'end_time',
        'date',
        'month',
        'year'
    ];
}
