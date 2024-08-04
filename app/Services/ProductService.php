<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductHistory;

class ProductService
{

    public function create($data)
    {
        $product = Product::query()->create($data);

        ProductHistory::query()->create([
            'product_id' => $product->id,
            'manager_id' => auth()->id(),
            'cost_price' => 0,
            'purchase_price' => $data['purchase_price'],
            'difference' => 0,
            'before' => $data['quantity'],
            'after' => $data['quantity'],
        ]);
    }

    public function update($request, $product)
    {
        $after = $product->quantity + $request->quantity;

        ProductHistory::query()->create([
            'product_id' => $product->id,
            'manager_id' => auth()->id(),
            'cost_price' => 0,
            'purchase_price' => $request->purchase_price,
            'difference' => $request->quantity,
            'before' => $product->quantity,
            'after' => $after,
        ]);

        $product->update([
            'name' => $request->name,
            'quantity' => $after,
            'cost_price' => 0,
            'purchase_price' => $request->purchase_price,
            'type' => $request->type
        ]);
    }
}
