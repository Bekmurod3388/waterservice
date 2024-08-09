<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'client_id', 'point_id', 'agent_id', 'user_id', 'is_completed',
        'service_cost_sum', 'product_cost_sum',
        'cash', 'card', 'terminal', 'transfer',
        'comment', 'service_time', 'type',
        'sms_code', 'sms_expire_time', 'status'
    ];

    public const TYPE_INSTALL = 1;
    public const TYPE_SERVICE = 2;


    public const INITIAL = 0;
    public const WAITING = 1;
    public const COMPLETED = 2;
    public const PAYED = 3;

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'task_services')->using(TaskService::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->hasMany(TaskProduct::class);
    }

    public function showProducts()
    {
        $productsInfoText = "";

        foreach ($this->products as $product) {
            if ($product->is_free)
                $productsInfoText .= $product->product->name . " - Bepul<br>";
            else
                $productsInfoText .= $product->product->name . ' - ' . $product->product_cost . " so'm<br>";
        }

        return $productsInfoText;
    }
}
