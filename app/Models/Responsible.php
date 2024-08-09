<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    use HasFactory;

    protected $fillable = ['cashier_id', 'operator_id', 'month'];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
    public function cashier(){
        return $this->belongsTo(User::class, 'cashier_id');
    }
}
