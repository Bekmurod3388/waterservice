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
            ->with(['tasks' => function ($query) {
                $query->select(
                    'user_id',
                    DB::raw('COUNT(*) as total_tasks'),
                    DB::raw('SUM(CASE WHEN is_completed = 0 THEN 1 ELSE 0 END) as incomplete_tasks'),
                    DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as complete_tasks')
                )
                    ->groupBy('user_id');
            }])
            ->paginate(10);

        return view('agents.index', [
            'agents' => $agents,
        ]);
    }
}
