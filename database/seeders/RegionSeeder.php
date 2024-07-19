<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            Region::query()->firstOrCreate(['name'=>'Urganch']);
            Region::query()->firstOrCreate(['name'=>'Urganch tuman']);
            Region::query()->firstOrCreate(['name'=>'Xonqa']);
            Region::query()->firstOrCreate(['name'=>'Bog\'ot']);
            Region::query()->firstOrCreate(['name'=>'Xazorasp']);
            Region::query()->firstOrCreate(['name'=>'Qo\'shko\'pir']);
            Region::query()->firstOrCreate(['name'=>'Xiva']);
            Region::query()->firstOrCreate(['name'=>'Xiva tuman']);
            Region::query()->firstOrCreate(['name'=>'Yangiariq']);
            Region::query()->firstOrCreate(['name'=>'Yangibozor']);
            Region::query()->firstOrCreate(['name'=>'Gurlan']);
            Region::query()->firstOrCreate(['name'=>'Shovot']);
            Region::query()->firstOrCreate(['name'=>'Tuproqqal\'a']);
    }
}
