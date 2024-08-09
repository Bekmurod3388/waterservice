<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductHistory;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function create($data)
    {

        $response = [];

        try {

            DB::beginTransaction();

            $product = Product::query()->create($data);

            ProductHistory::query()->create([
                'product_id' => $product->id,
                'manager_id' => auth()->id(),
                'cost_price' => 0,
                'purchase_price' => $data['purchase_price'],
                'difference' => 0,
                'before' => $data['quantity'],
                'after' => $data['quantity'],
                'service_price' => $data['service_price']
            ]);

            DB::commit();
            $response = ['key' => 'success', 'message' => 'Muvaffaqiyatli yaratildi'];

        } catch (\Exception $exception) {

            DB::rollBack();
            $response = ['key' => 'error', 'message' => $exception->getMessage()];

        }
        return $response;

    }

    public function update($request, $product)
    {

        $after = $product->quantity + $request->quantity;

        try {

            DB::beginTransaction();

            ProductHistory::query()->create([
                'product_id' => $product->id,
                'manager_id' => auth()->id(),
                'cost_price' => 0,
                'purchase_price' => $request->purchase_price,
                'difference' => $request->quantity,
                'before' => $product->quantity,
                'after' => $after,
                'service_price' => $request->service_price
            ]);

            $product->update([
                'name' => $request->name,
                'quantity' => $after,
                'cost_price' => 0,
                'purchase_price' => $request->purchase_price,
                'type' => $request->type,
                'service_price' => $request->service_price
            ]);

            DB::commit();
            $response = ['key' => 'success', 'message' => 'Muvaffaqiyatli yaratildi'];

        } catch (\Exception $exception) {

            DB::rollBack();
            $response = ['key' => 'error', 'message' => $exception->getMessage()];

        }

//        dd($response);
        return $response;

    }
}
