<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'taskId',
    ];
}
