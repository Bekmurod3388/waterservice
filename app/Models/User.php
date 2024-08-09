<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'latitude',
        'longitude',
        'last_active_time'
    ];





    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'agent_id');
    }


    public function countProduct($id){

        $number = AgentProduct::where('agent_id',$id)->get();
        $sum=0;
        $count = 0;
        foreach ($number as $item){

            $sum += $item -> price;
            $count += $item -> quantity;

        }

        $result = str($count) .'  /  ' . str( $sum) ;
        return $result;
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
