<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installments extends Model
{
    use HasFactory;
    public const STATUS_START = 0;
    public const STATUS_INITIAL = 1;
    public const STATUS_CHANGE_TIME = 2;
    public const STATUS_FINISHED = 3;
}
