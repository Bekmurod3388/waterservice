<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Task;

class AgentController extends Controller
{
    public function getTasks()
    {
        return response()->json([
            'tasks' => Task::with('point', 'client')->where('agent_id', auth()->id())->get()
        ]);
    }

    public function task(Task $task){
        return response()->json(
            [
                "task" => $task,
                "client" => $task->client(),
                "point" => $task->point(),
                "services" => $task->services(),
                "all_services" => Service::all()
            ]);
    }
}
