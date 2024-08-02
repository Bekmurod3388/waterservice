<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Point;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use Illuminate\Database\Seeder;

class MockDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filters = [
            ['name' => 'test filter', 'purchase_price' => 123000, 'quantity' => 10, 'type' => 1],
            ['name' => 'test2 filter', 'purchase_price' => 456000, 'quantity' => 10, 'type' => 1]
        ];

        foreach ($filters as $filterData) {
            $filter = Product::query()->firstOrCreate($filterData);
            echo "Created Filter: " . $filter->name . "\n";
        }

        $services = [
            ['name' => 'test servis', 'cost' => 654000],
            ['name' => 'test2 servis', 'cost' => 132000]
        ];

        foreach ($services as $serviceData) {
            $service = Service::query()->firstOrCreate($serviceData);
            echo "Created Service: " . $service->name . "\n";
        }

        $clients = [
            ['name' => 'test client', 'phone' => '991324657'],
            ['name' => 'test2 client', 'phone' => '991324651']
        ];

        foreach ($clients as $clientData) {
            $client = Client::query()->firstOrCreate($clientData);
            echo "Created Client: " . $client->name . "\n";
        }

        $points = [
            ['client_name' => 'test client', 'filter_name' => 'test filter', 'address' => 'test address'],
            ['client_name' => 'test2 client', 'filter_name' => 'test2 filter', 'address' => 'test2 address'],
            ['client_name' => 'test2 client', 'filter_name' => 'test filter', 'address' => 'test3 address']
        ];

        foreach ($points as $pointData) {
            $client = Client::where('name', $pointData['client_name'])->first();
            $filter = Product::where('name', $pointData['filter_name'])->first();
            $region = Region::query()->inRandomOrder()->first();

            if ($client && $filter && $region) {
                $point = Point::query()->firstOrCreate([
                    'client_id' => $client->id,
                    'region_id' => $region->id,
                    'address' => $pointData['address'],
                    'filter_id' => $filter->id,
                    'filter_expire' => 3,
                    'filter_expire_date' => now()
                ]);
                echo "Created Point for Client: " . $client->name . " and Filter: " . $filter->name . "\n";
            }
        }
    }
}
