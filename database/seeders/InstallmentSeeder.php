<?php

namespace Database\Seeders;

use App\Models\Installments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstallmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Installments::query()->firstOrCreate(
            [
                'point_id' => '1',
                'filter_cost'=>'1000000',
                'period_month'=>'6',
                'initial_fee'=>'300000',
                'remaining_amount'=>'700000',
                'status'=>Installments::STATUS_START,
                'payment_day'=>'2024-10-15',
                'responsible_person_id'=>'1',
                'is_finished'=>'0',
            ]
        );
        Installments::query()->firstOrCreate(
            [
                'point_id' => '2',
                'filter_cost'=>'750000',
                'period_month'=>'12',
                'initial_fee'=>'220000',
                'remaining_amount'=>'530000',
                'status'=>Installments::STATUS_INITIAL,
                'payment_day'=>'2024-10-15',
                'responsible_person_id'=>'2',
                'is_finished'=>'0',
            ]
        );
        Installments::query()->firstOrCreate(
            [
                'point_id' => '3',
                'filter_cost'=>'4500000',
                'period_month'=>'3',
                'initial_fee'=>'100000',
                'remaining_amount'=>'3500000',
                'status'=>Installments::STATUS_CHANGE_TIME,
                'payment_day'=>'2024-10-15',
                'responsible_person_id'=>'2',
                'is_finished'=>'0',
            ]
        );
        Installments::query()->firstOrCreate(
            [
                'point_id' => '4',
                'filter_cost'=>'1500000',
                'period_month'=>'4',
                'initial_fee'=>'100000',
                'remaining_amount'=>'0',
                'status'=>Installments::STATUS_FINISHED,
                'payment_day'=>'2024-10-15',
                'responsible_person_id'=>'1',
                'is_finished'=>'1',
            ]
        );
    }
}
