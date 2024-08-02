<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class MobileAgentController extends Controller
{
    public function index($token)
    {
        return view('mobile.agent.pages.home', [
            'tasks' => Task::with('point')->where('user_id', auth()->id())->get(),
            'token' => $token
        ]);
    }
    public function history($token)
    {
        return view('mobile.agent.pages.history', [
            'tasks' => Task::with('point')->where('user_id', auth()->id())->get(),
            'token' => $token
        ]);
    }
    public function settings($token)
    {
        return view('mobile.agent.pages.settings', [
            'tasks' => Task::with('point')->where('user_id', auth()->id())->get(),
            'token' => $token
        ]);
    }
    public function products($token)
    {
        return view('mobile.agent.pages.products', [
            'tasks' => Task::with('point')->where('user_id', auth()->id())->get(),
            'token' => $token
        ]);
    }
}
