<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable; 
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // use Notifiable;
    use Sortable;   // 追加
    public $sortable = ['id' , 'task' , 'User'];    // ソート対象カラム追加

    //hasMany設定
    public function Show_task()
    {
        return $this->hasMany(Stask::class)->where('userId', 'a');
    }
}
