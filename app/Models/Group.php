<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'group_leader_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups')->withTimestamps();
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'group_leader_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'group_id');
    }

    public function isManagedBy(User $user): bool
    {
        return (int) $this->group_leader_id === (int) $user->id;
    }
}
