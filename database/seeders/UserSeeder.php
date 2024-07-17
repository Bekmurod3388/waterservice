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
        User::create([
            'name' => 'admin',
            'phone' => '123456789',
            'password' => Hash::make('admin'),
        ])->assignRole('admin');

        User::create([
            'name' => 'user',
            'phone' => '987654321',
            'password' => Hash::make('user'),
        ])->assignRole('user');
    }
}
