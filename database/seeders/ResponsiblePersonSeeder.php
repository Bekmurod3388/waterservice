<?php

namespace Database\Seeders;

use App\Models\Responsible;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponsiblePersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Responsible::query()->firstOrCreate(
            [
                'cashier_id' => '12',
                'operator_id' => '10',
                'month' => '2024-10-01',
            ]
        );
        Responsible::query()->firstOrCreate(
            [
                'cashier_id' => '13',
                'operator_id' => '11',
                'month' => '2024-09-01',
            ]
        );
    }
}
