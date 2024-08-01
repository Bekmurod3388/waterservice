<?php

namespace App\Services;

use App\Models\ProductHistory;

class ProductHistoryCreateService
{

    public function create($data)
    {
        ProductHistory::create([
            'product_id' => $data->id,
            'user_id' => auth()->id(),
            'cost_price' => 0,
            'purchase_price' => $data->purchase_price,
            'differance' => 0,
            'before' => $data->quantity,
            'after' => $data->quantity,
        ]);
    }

    public function update($request, $product)
    {
        $after = $product->quantity + $request->quantity;

        ProductHistory::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'cost_price' => 0,
            'purchase_price' => $request->purchase_price,
            'differance' => $request->quantity,
            'before' => $product->quantity,
            'after' => $after,
        ]);

        $product->update([
            'name'=>$request->name,
            'quantity'=>$after,
            'cost_price'=>0,
            'purchase_price'=>$request->purchase_price,
            'type'=>$request->type
        ]);

    }

}
