<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'status',
        'birthday',
        'region_id',
        'gender',
    ];

    public function region(){
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
