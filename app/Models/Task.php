<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task',
        'group_id',
    ];
    // use Notifiable;
    use Sortable;   // 追加
    public $sortable = ['id' , 'task' , 'user'];    // ソート対象カラム追加

    //hasMany設定
    public function viewers(): HasMany
    {
        return $this->hasMany(TaskViewer::class, 'task_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'task_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function scopeVisibleTo($query, User $user)
    {
        return $query->where(function ($query) use ($user) {
            $query->where('user', $user->name)
                ->orWhereHas('viewers', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orWhereHas('group.users', function ($query) use ($user) {
                    $query->whereKey($user->id);
                });
        });
    }

    public function isManagedBy(User $user): bool
    {
        return $this->user === $user->name
            || ($this->group !== null && (int) $this->group->group_leader_id === (int) $user->id);
    }

    public function isAccessibleTo(User $user): bool
    {
        return Task::query()
            ->whereKey($this->getKey())
            ->visibleTo($user)
            ->exists();
    }
}
