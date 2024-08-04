<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $table = 'product_history';

    protected $fillable = ['product_id', 'manager_id', 'cost_price', 'purchase_price', 'difference', 'before', 'after','service_price'];
}
