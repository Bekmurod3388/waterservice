<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost'];
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_services')->using(TaskService::class);
    }
}
