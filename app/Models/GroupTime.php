<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'time_id',
        'active',
        'created_at',
        'updated_at',
    ];
}
