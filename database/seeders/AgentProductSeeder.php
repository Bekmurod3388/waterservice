<?php

namespace Database\Seeders;

use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class AgentProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (range(1, 10) as $index) {
            AgentProduct::query()->forceCreate([
                'agent_id' => User::query()->role('agent')->inRandomOrder()->first()->id,
                'product_id' => Product::query()->inRandomOrder()->first()->id,
                'quantity' => rand(1, 10),
                'price' => rand(1, 100),
                'service_price' => rand(1, 100),
            ]);
        }
    }
}
