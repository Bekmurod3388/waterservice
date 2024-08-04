<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProductHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'operator_agent_id', 'product_id', 'difference', 'before', 'after','price'
    ];
}
