<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgentProduct;
use App\Models\Product;
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

    public function task(Task $task)
    {
        $task->load('client:id,name,phone,description', 'point.region', 'services');

        return response()->json(
            [
                "task" => $task,
                "agent_products" => AgentProduct::query()
                    ->with('product:id,name,type')
                    ->whereHas('product', function ($q) {
                        $q->where('type', Product::TYPE_PRODUCT);
                    })
                    ->where('agent_id', auth()->id())
                    ->get()
            ]);
    }
}
