<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'purchase_price', 'cost_price', 'quantity', 'type','service_price'];
    const TYPE_FILTER = 1;
    const TYPE_PRODUCT = 2;

    public function getTypeLabelAttribute()
    {
        return $this->type == self::TYPE_FILTER ? 'Filter' : 'Mahsulot';
    }


}
