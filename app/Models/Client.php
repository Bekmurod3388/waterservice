<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'operator_dealer_id', 'telegram_id', 'description'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_dealer_id');
    }

    public function scopeFilterByOperator($query)
    {
        if (!auth()->user()->hasRole(['admin|manager|operator_agent'])) {
            $query->where('operator_dealer_id', auth()->id());
        }
    }
}
