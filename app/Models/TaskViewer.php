<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskViewer extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'taskId',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class , 'taskId');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'userId');
    }
}
