<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'latitude', 'longitude', 'region_id', 'address', 'filter_id', 'filter_expire_month'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
