<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Filter;
use App\Models\Point;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MockDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filter = Product::query()->firstOrCreate([
            'name' => 'test filter',
            'purchase_price' => 123000,
            'quantity'=>10,
            'type'=>'filter'

        ]);

        Service::query()->firstOrCreate([
            'name' => 'test servis',
            'cost' => 654000
        ]);

        $client = Client::query()->firstOrCreate([
            'name' => 'test client',
            'phone' => '991324657'
        ]);

        Point::query()->firstOrCreate([
            'client_id' => $client->id,
            'region_id' => Region::query()->inRandomOrder()->first()->id,
            'address' => 'test address',
            'filter_id' => $filter->id,
            'filter_expire' => 3,
            'filter_expire_date' => now()
        ]);
    }
}
