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
            ['name' => 'test filter', 'purchase_price' => 123000, 'quantity' => 10, 'type' => Product::TYPE_FILTER],
            ['name' => 'test2 filter', 'purchase_price' => 456000, 'quantity' => 10, 'type' => Product::TYPE_FILTER]
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

        $operator = User::role('operator_dealer')->first();

        if ($operator) {
            $clients = [
                ['name' => 'Bekmurod', 'phone' => '977913883', 'operator_dealer_id' => $operator->id],
                ['name' => 'Azamat', 'phone' => '940810048', 'operator_dealer_id' => $operator->id]
            ];

            foreach ($clients as $clientData) {
                Client::query()->firstOrCreate(
                    [
                        'phone' => $clientData['phone']
                    ],
                    $clientData
                );
            }

            $points = [
                ['client_phone' => '977913883', 'filter_name' => 'test filter', 'address' => 'test address'],
                ['client_phone' => '920810048', 'filter_name' => 'test2 filter', 'address' => 'test2 address'],
            ];

            foreach ($points as $pointData) {
                $client = Client::query()->where('phone', $pointData['client_phone'])->first();
                $filter = Product::query()->inRandomOrder()->first();
                $region = Region::query()->inRandomOrder()->first();

                if ($client && $filter && $region) {
                    Point::query()->create([
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
