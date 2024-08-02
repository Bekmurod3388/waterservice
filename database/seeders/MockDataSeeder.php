<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Point;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
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
            Product::query()->firstOrCreate($filterData);
        }

        $services = [
            ['name' => 'test servis', 'cost' => 654000],
            ['name' => 'test2 servis', 'cost' => 132000]
        ];

        foreach ($services as $serviceData) {
            Service::query()->firstOrCreate($serviceData);
        }

        $operator = User::whereHas('roles', function($q) {
            $q->where('name', 'operator_dealer');
        })->first();

        if ($operator) {
            $clients = [
                ['name' => 'test client', 'phone' => '991324657', 'operator_dealer_id' => $operator->id],
                ['name' => 'test2 client', 'phone' => '991324651', 'operator_dealer_id' => $operator->id]
            ];

            foreach ($clients as $clientData) {
                Client::query()->firstOrCreate($clientData);
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
                    Point::query()->firstOrCreate([
                        'client_id' => $client->id,
                        'region_id' => $region->id,
                        'address' => $pointData['address'],
                        'filter_id' => $filter->id,
                        'filter_expire' => 3,
                        'filter_expire_date' => now()
                    ]);
                }
            }
        } else {
            $this->command->error('No operator dealer found. Please seed operator dealers first.');
        }
    }
}
