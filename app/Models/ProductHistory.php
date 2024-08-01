<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $table = 'product_history';

    protected $fillable = ['product_id','user_id','cost_price','purchase_price','differance','before','after'];
}
