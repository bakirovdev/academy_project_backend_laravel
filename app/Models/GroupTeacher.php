<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
        'active'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function group(){
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
