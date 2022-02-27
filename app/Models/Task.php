<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable; 
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'task',
        'user',
        'group_id',
        'created_at',
        'updated_at'
    ];
    // use Notifiable;
    use Sortable;   // 追加
    public $sortable = ['id' , 'task' , 'user'];    // ソート対象カラム追加

    //hasMany設定
    public function view()
    {
        return $this->hasOne(TaskViewer::class , 'task_id');
    }
}
