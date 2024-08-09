<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->hasRole([ 'admin' ])) {
            return view('dashboard', [
                'number_client' => Client::count(),
                'new_clients' => Client::whereDate('created_at', Carbon::today())->count(),
                'agents' => User::role('agent')->withCount([
                    'tasks as incomplete_tasks' => function ($query) {
                        $query->where('is_completed', 0);//->whereDate('created_at', today()->format('Y-m-d'));
                    },
                    'tasks as complete_tasks' => function ($query) {
                        $query->where('is_completed', 1);//->whereDate('created_at', today()->format('Y-m-d'));
                    }
                ])->get(),
            ]);
        }
        if (auth()->user()->hasRole('operator_cashier')) {
            return redirect()->route('installments.index');
        }
        return redirect()->route('clients.index');
    }

    public function logs()
    {
        checkPermission('show_log');

        return view('logs', [
            'logs' => Log::query()->latest()->paginate(15)
        ]);
    }

    public function map()
    {
        checkPermission('show_map');

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
