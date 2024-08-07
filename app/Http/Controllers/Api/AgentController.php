<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskProduct;
use Illuminate\Http\JsonResponse;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\Task;

class AgentController extends Controller
{
    public function __construct(
        protected MessageService $service
    )
    {
    }

    public function getTasks(): JsonResponse
    {
        return response()->json([
            'tasks' => Task::with('point', 'client')->where('agent_id', auth()->id())->get()
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
            'products' => 'array'
        ]);


        foreach ($request->get('products') as $product) {
            TaskProduct::query()->create([
                'agent_id' => auth()->id(),
                'task_id' => $task->id,
                'is_free' => $product['isFree'],
                'product_id' => $product['id'],
                'quantity' => 1,
                'product_cost' => $product['price']
            ]);

            AgentProduct::query()
                ->where('product_id', $product['product_id'])
                ->where('agent_id', auth()->id())
                ->decrement('quantity');
        }

        $code = mt_rand(100000, 999999);

        $task->update([
            'service_cost_sum',
            'product_cost_sum',
            'status' => Task::WAITING,
            'sms_code' => $code,
            'sms_expire_time' => now()->addMinutes(2)
        ]);

        $phone = $task->client?->phone;
//        $this->service->sendMessage($phone, "Tasdiqlash kodi: $code");

        return response()->json([
            'success' => true
        ]);
    }

    public function verify(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'code' => 'required|int'
        ]);

        if (now()->greaterThan($task->sms_expire_time) && $request->get('code') == $task->sms_code) {

            $task->update([
                'status' => Task::COMPLETED,
                'sms_code' => null,
                'sms_expire_time' => null,
                'is_completed' => true
            ]);

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
