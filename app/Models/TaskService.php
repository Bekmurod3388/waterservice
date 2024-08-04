<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskService extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'task_id', 'status', 'service_cost', 'agent_id', 'is_free'];
}
