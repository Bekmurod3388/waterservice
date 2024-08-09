<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'task_id', 'is_free', 'product_id', 'quantity', 'product_cost', 'is_checked'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
