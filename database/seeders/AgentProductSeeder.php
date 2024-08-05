<?php

namespace Database\Seeders;

use App\Models\AgentProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'agent_id' => rand(6,9),
                'product_id' => $index,
                'quantity' => rand(1, 10),
                'price' => rand(1, 100),
                'service_price' => rand(1, 100),
            ]);
        }

    }
}
