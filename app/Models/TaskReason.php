<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReason extends Model
{
    use HasFactory;

    protected $fillable = ['point_id', 'reason', 'filter_expire_date'];
}
