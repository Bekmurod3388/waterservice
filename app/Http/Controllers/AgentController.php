<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        return view('agents.index', [
            'agents' => User::query()->whereHas('roles', function ($query) {
                $query->where('name', 'agent');
            })->paginate(10),

        ]);
    }
}
