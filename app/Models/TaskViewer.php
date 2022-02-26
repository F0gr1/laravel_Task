<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskViewer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class , 'task_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
