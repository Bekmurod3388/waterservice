<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::query()->firstOrCreate(
            [
                'phone' => '123456789',
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
            ]
        );
        $admin->assignRole('admin');

        // Manager
        $manager = User::query()->firstOrCreate(
            [
                'phone' => '987654321',
            ],
            [
                'name' => 'manager',
                'password' => Hash::make('admin'),
            ]
        );
        $manager->assignRole('manager');

        // Seller operator
        $operator = User::query()->firstOrCreate(
            [
                'phone' => '123123123',
            ],
            [
                'name' => 'operator',
                'password' => Hash::make('admin'),
            ]
        );
        $operator->assignRole('operator_dealer');

        // Dealer
        $dealer = User::query()->firstOrCreate(
            [
                'phone' => '123123122'
            ],
            [
                'name' => 'diller',
                'password' => Hash::make('admin')
            ]
        );
        $dealer->assignRole('dealer');

        // Service operator
        $operator2 = User::query()->firstOrCreate(
            [
                'phone' => '345345345',
            ],
            [
                'name' => 'operator2',
                'password' => Hash::make('admin'),
            ]
        );
        $operator2->assignRole('operator_agent');

        // Agent
        $agent = User::query()->firstOrCreate(
            [
                'phone' => '123123124',
            ],
            [
                'name' => 'agent1',
                'password' => Hash::make('admin'),
                'latitude' => 41.551,
                'longitude' => 60.6334,
                'last_active_time' => now()
            ]
        );
        $agent->assignRole('agent');$agent = User::query()->firstOrCreate(
            [
                'phone' => '111111111',
            ],
            [
                'name' => 'agent2',
                'password' => Hash::make('admin'),
                'latitude' => 41.551,
                'longitude' => 60.6334,
                'last_active_time' => now()
            ]
        );
        $agent->assignRole('agent');$agent = User::query()->firstOrCreate(
            [
                'phone' => '222222222',
            ],
            [
                'name' => 'agent3',
                'password' => Hash::make('admin'),
                'latitude' => 41.551,
                'longitude' => 60.6334,
                'last_active_time' => now()
            ]
        );
        $agent->assignRole('agent');$agent = User::query()->firstOrCreate(
            [
                'phone' => '333333333',
            ],
            [
                'name' => 'agent4',
                'password' => Hash::make('admin'),
                'latitude' => 41.551,
                'longitude' => 60.6334,
                'last_active_time' => now()
            ]
        );
        $agent->assignRole('agent');

        // Cashier operator
        $operator3 = User::query()->firstOrCreate(
            [
                'phone' => '889568874',
            ],
            [
                'name' => 'Casher Operator 1',
                'password' => Hash::make('admin'),
            ]
        );
        $operator3->assignRole('operator_cashier');

        $operator3 = User::query()->firstOrCreate(
            [
                'phone' => '908578445',
            ],
            [
                'name' => 'Casher Operator 2',
                'password' => Hash::make('admin'),
            ]
        );
        $operator3->assignRole('operator_cashier');

        // Cashier
        $cashier = User::query()->firstOrCreate(
            [
                'phone' => '935689965',
            ],
            [
                'name' => 'Casher 1',
                'password' => Hash::make('admin'),
            ]
        );
        $cashier->assignRole('cashier');

        $cashier = User::query()->firstOrCreate(
            [
                'phone' => '9415254117',
            ],
            [
                'name' => 'Casher 2',
                'password' => Hash::make('admin'),
            ]
        );
        $cashier->assignRole('cashier');

    }
}
