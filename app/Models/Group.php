<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class , 'id');
    }
    public function  group()
    {
        return $this->hasMany(UsersGroup::class ,'group_id');
    }
}
