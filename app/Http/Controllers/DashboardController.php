<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function logs()
    {
        return view('logs', [
            'logs' => Log::query()->latest()->paginate(15)
        ]);
    }

    public function map()
    {
        return view('map', [
            'users' => User::query()->whereHas('roles', function ($q) {
                $q->whereIn('name', ['dealer', 'agent', 'cashier']);
            })
        ]);
    }

    public function getMarkers()
    {
        $markers = User::query()
            ->select('id', 'name', 'latitude', 'longitude')
            ->with('roles')
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['dealer', 'agent', 'cashier']);
            })
            ->get()
            ->map(function ($user) {
                $role = $user->roles->first()->name;

                // Add a new attribute 'type' based on the first role name
                $user->type = match ($role) {
                    'dealer' => 'dealer',
                    'agent' => 'agent',
                    'cashier' => 'cashier',
                    default => 'Unknown Type',
                };
                unset($user->roles);
                return $user;
            });

        return response()->json($markers);
    }
}
