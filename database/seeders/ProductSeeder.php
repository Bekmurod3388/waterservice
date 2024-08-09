<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->firstOrCreate(
            [
                'name' => 'ruchka',
                'purchase_price' => '623000',
                'cost_price' => 123123,
                'quantity' => 40,
                'type' => Product::TYPE_PRODUCT,
                'service_price' => 0,
            ]
        );
        Product::query()->firstOrCreate(
            [
                'name' => 'qalam',
                'purchase_price' => '523000',
                'cost_price' => 123123,
                'quantity' => 30,
                'type' => Product::TYPE_PRODUCT,
                'service_price' => 0,
            ]
        );
        Product::query()->firstOrCreate(
            [
                'name' => 'kitob',
                'purchase_price' => '323000',
                'cost_price' => 123123,
                'quantity' => 20,
                'type' => Product::TYPE_PRODUCT,
                'service_price' => 0,
            ]
        );
        Product::query()->firstOrCreate(
            [
                'name' => 'daftar',
                'purchase_price' => '123000',
                'cost_price' => 123123,
                'quantity' => 50,
                'type' => Product::TYPE_PRODUCT,
                'service_price' => 0,
            ]
        );
    }
}
