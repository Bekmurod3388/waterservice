<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'latitude', 'longitude', 'region_id', 'address',
        'dealer_id', 'demo_time', 'operator_comment', 'dealer_comment',
        'filter_id', 'filter_expire', 'filter_expire_date', 'filter_cost',
        'status', 'is_full_pay', 'invited_client_id', 'contract_date',
        'installation_date', 'operator_dealer_id',
    ];

    protected $casts = [
        'filter_expire_date' => 'date',
        'contract_date' => 'date',
        'installation_date' => 'date',
    ];

    public const STATUS_CANCEL = -1;
    public const STATUS_NEW = 0;
    public const STATUS_SOLD = 1;
    public const STATUS_AGENT = 2;
    public const STATUS_INSTALLED = 3;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function filter()
    {
        return $this->belongsTo(Product::class, 'filter_id');
    }

    public function lastReason()
    {
        return $this->hasOne(TaskReason::class)->latestOfMany();
    }

    public function scopeFilterDate($query, $filter)
    {
        if ($filter === 'yesterday') {
            $query->whereDate('filter_expire_date', '<=', now()->subDay()->toDateString());
        } elseif ($filter === 'tomorrow') {
            $query->whereDate('filter_expire_date', now()->addDay()->toDateString());
        } elseif ($filter === 'week') {
            $query->whereBetween('filter_expire_date', [now()->startOfWeek(), now()->endOfWeek()]);
        } else {
            $query->whereDate('filter_expire_date', now()->toDateString());
        }
    }

    public function scoperSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {

                $query->whereAny(['id', 'address'], 'LIKE', "%$search%");

                $query->orWhereHas('client', function ($q) use ($search) {
                    $q->whereAny(['name'], 'LIKE', "%$search%");
                });

                $query->orWhereHas('region', function ($q) use ($search) {
                    $q->whereAny(['name'], 'LIKE', "%$search%");
                });

            });
        }
    }

    public function showLocation()
    {
        if ($this->latitude && $this->longitude) {
            $link = "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
            return "<a href=$link target='_blank' class='btn btn-warning'>Joylashuv</a>";
        }
        return "-";
    }
}
