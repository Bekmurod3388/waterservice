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
                'name' => 'agent',
                'password' => Hash::make('admin'),
                'latitude' => 41.551,
                'longitude' => 60.6334,
                'last_active_time' => now()
            ]
        );
        $agent->assignRole('agent');

    }
}
