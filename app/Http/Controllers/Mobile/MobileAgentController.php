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
        $user = getUser($token);

        return view('mobile.agent.pages.home', [
            'tasks' => Task::with('point')->where('user_id', $user->id)->get(),
        ]);
    }
}
