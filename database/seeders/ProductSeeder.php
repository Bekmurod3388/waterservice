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
        for ( $i=1 ; $i<=10; $i++) {
            Product::query()->firstOrCreate([
                'name' => 'filter' . $i,
                'purchase_price' => $i . '000'
            ]);
        }
    }
}
