<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index()
    {
        $agents = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'agent');
            })
            ->withCount([
                'tasks as incomplete_tasks' => function ($query) {
                    $query->where('is_completed', 0);//->whereDate('created_at', today()->format('Y-m-d'));
                },
                'tasks as complete_tasks' => function ($query) {
                    $query->where('is_completed', 1);//->whereDate('created_at', today()->format('Y-m-d'));
                }
            ])
            ->paginate(10);

        return view('agents.index', [
            'agents' => $agents,
        ]);

    }
}
