<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        // send sms
        $code = mt_rand(1111, 9999);

        $task->update([
            'sms_code' => $code,
            'sms_expire_time' => now()->addMinutes(2)
        ]);

        $phone = $task->client?->phone;
        $this->service->sendMessage($phone, "Tasdiqlash kodi: $code");

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
