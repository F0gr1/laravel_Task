<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'task_id',
        'project',
        'PIC',
        'progress',
        'memo',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}
