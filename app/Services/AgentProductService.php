<?php

namespace App\Services;

use App\Models\AgentProduct;
use App\Models\AgentProductHistory;
use App\Models\Product;
use App\Models\ProductHistory;
use Illuminate\Support\Facades\DB;

class AgentProductService
{
    public function create($data, $agent)
    {
        $response = [];
        try {
            DB::beginTransaction();
            $product = Product::query()->where('id', $data['product_id'])->firstOrFail();

            if ($product->quantity >= $data['quantity']) {
                $after = $product->quantity - $data['quantity'];

                ProductHistory::query()->create([
                    'product_id' => $product->id,
                    'manager_id' => auth()->id(),
                    'cost_price' => 0,
                    'purchase_price' => $product->purchase_price,
                    'difference' => -$data['quantity'],
                    'before' => $product->quantity,
                    'after' => $after,
                    'service_price' => $product->service_price
                ]);

                $product->quantity = $after;
                $product->save();

                $agentProduct = AgentProduct::query()
                    ->where('agent_id', $agent->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($agentProduct) {
                    $agentProduct->quantity += $data['quantity'];
                    $agentProduct->save();

                    AgentProductHistory::query()->create([
                        'agent_id' => $agent->id,
                        'operator_agent_id' => auth()->id(),
                        'product_id' => $product->id,
                        'difference' => $data['quantity'],
                        'before' => $agentProduct->quantity - $data['quantity'],
                        'after' => $agentProduct->quantity,
                        'service_price' => $product->service_price,
                        'price' => $product->purchase_price
                    ]);
                }
                else {

                    AgentProduct::query()->create([
                        'agent_id' => $agent->id,
                        'product_id' => $product->id,
                        'quantity' => $data['quantity'],
                        'price' => $product->purchase_price,
                        'service_price' => $product->service_price
                    ]);

                    AgentProductHistory::query()->create([
                        'agent_id' => $agent->id,
                        'operator_agent_id' => auth()->id(),
                        'product_id' => $product->id,
                        'difference' => $data['quantity'],
                        'before' => 0,
                        'after' => $data['quantity'],
                        'service_price' => $product->service_price,
                        'price' => $product->purchase_price
                    ]);
                }

                DB::commit();
                $response = ['key' => 'success', 'message' => 'Muvaffaqiyatli yaratildi'];
            } else {
                DB::rollBack();
                $response = ['key' => 'error', 'message' => 'Ombordagi mahsulot soni yetarli emas!'];
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            $response = ['key' => 'error', 'message' => $exception->getMessage()];
        }
        return $response;
    }
}
