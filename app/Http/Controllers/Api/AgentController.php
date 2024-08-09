<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskProduct;
use App\Services\AgentTaskService;
use Illuminate\Http\JsonResponse;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\Task;
use Illuminate\Support\Carbon;

class AgentController extends Controller
{
    public function __construct(
        protected MessageService   $service,
        protected AgentTaskService $taskService
    )
    {
    }

    public function getAgentProducts(): JsonResponse
    {
        return response()->json([
            'products' => AgentProduct::query()
                ->with('product:id,name,type')
                ->where('agent_id', auth()->id())
                ->get()
        ]);
    }

    public function getTasks(): JsonResponse
    {
        return response()->json([
            'tasks' => Task::query()
                ->with('point', 'client')
                ->whereIn('status', [Task::INITIAL, Task::WAITING])
                ->where('agent_id', auth()->id())
                ->get()
        ]);
    }

    public function task(Task $task): JsonResponse
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

    public function complete(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'products' => 'array',
            'products.*.id' => 'int',
            'products.*.isFree' => 'bool',
            'products.*.price' => 'int',
            'products.*.servicePrice' => 'int'
        ]);

        $message = $this->taskService->complete($task, $request->get('products'));


        $phone = $task->client?->phone;
        $this->service->sendMessage($phone, $message);

        return response()->json([
            'success' => true
        ]);
    }

    public function verify(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'code' => 'required|int'
        ]);

        if (now()->lessThan($task->sms_expire_time) && $request->get('code') == $task->sms_code) {

            $message = $this->taskService->verify($task);

            $phone = $task->client?->phone;
            $this->service->sendMessage($phone, $message);

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function completedTasks(Request $request): JsonResponse
    {
        $request->validate([
            'completed_time' => 'required|string'
        ]);

        $completedTime = \DateTime::createFromFormat('d/m/Y', $request['completed_time']);

        if (!$completedTime) {
            abort(400, 'Invalid date format. Please use dd/mm/yyyy.');
        }

        return response()->json([
            'tasks' => Task::query()
                ->with('client:id,name,phone,description', 'point.region', 'services')
                ->where('status', Task::COMPLETED)
                ->where('agent_id', auth()->id())
                ->whereDate('service_time', $completedTime->format('Y-m-d'))
                ->get()
        ]);
    }
}
