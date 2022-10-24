<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'monthly_price',
        'daily_price',
        'active'
    ];
}
