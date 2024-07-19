<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'latitude', 'longitude', 'region_id', 'address', 'filter_id', 'filter_expire', 'filter_expire_date'
    ];

    protected $casts = [
        'filter_expire_date' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
