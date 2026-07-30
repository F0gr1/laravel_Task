<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGroup extends Model
{
    use HasFactory;

    protected $table = 'users_groups';

    protected $fillable = [
        'user_id',
        'group_id',
    ];
}
