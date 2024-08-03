<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'latitude', 'longitude', 'region_id', 'address',
        'filter_id', 'filter_expire', 'filter_expire_date', 'filter_cost',
        'status', 'is_full_pay', 'invited_client_id', 'contract_date',
        'installation_date', 'operator_dealer_id', 'dealer_id', 'demo_time'
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
