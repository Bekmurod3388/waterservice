<?php

namespace App\Services;

use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\Task;
use App\Models\TaskProduct;
use Illuminate\Support\Facades\Cache;

class AgentTaskService
{
    public function complete(Task $task, $items = [])
    {
        $agentId = auth()->id();
        $products = Product::query()->whereIn('id', array_column($items, 'id'))->pluck('name', 'id')->toArray();

        $productsPrice = 0;
        $servicePrice = 0;
        $productsInfoText = "";

        foreach ($items as $item) {
            if ($item['servicePrice'] >= $servicePrice) $servicePrice = $item['servicePrice'];

            if ($item['isFree']) $productsInfoText .= $products[$item['id']] . " - Bepul\n";
            else {
                $productsInfoText .= $products[$item['id']] . ' - ' . $item['price'] . " so'm\n";
                $productsPrice += $item['price'];
            }
        }

        Cache::put("agent_task_complete_$agentId", [
            'products' => $products,
            'product_cost_sum' => $productsPrice,
            'service_cost_sum' => $servicePrice,
            'productsInfoText' => $productsInfoText
        ], now()->addMinutes(5));


        $code = mt_rand(100000, 999999);

        $task->update([
            'status' => Task::WAITING,
            'sms_code' => $code,
            'sms_expire_time' => now()->addMinutes(2)
        ]);

        return $code;
    }

    public function verify(Task $task)
    {
        $agentId = auth()->id();
        $data = Cache::get("agent_task_complete_$agentId");

        foreach ($data['products'] as $product) {
            TaskProduct::query()->create([
                'agent_id' => $agentId,
                'task_id' => $task->id,
                'is_free' => $product['isFree'],
                'is_checked' => 0, // bazada default barib berdan o`chirish garak
                'product_id' => $product['id'],
                'quantity' => 1,
                'product_cost' => $product['price']
            ]);

            AgentProduct::query()
                ->where('product_id', $product['id'])
                ->where('agent_id', $agentId)
                ->decrement('quantity');
        }

        $task->update([
            'service_cost_sum' => $data['service_cost_sum'],
            'product_cost_sum' => $data['product_cost_sum'],
            'status' => Task::COMPLETED,
            'sms_code' => null,
            'sms_expire_time' => null,
            'is_completed' => true
        ]);
    }


}
