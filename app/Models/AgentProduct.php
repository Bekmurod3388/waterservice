<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProduct extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'product_id', 'quantity','price','service_price'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
