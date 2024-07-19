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

            Region::create(['name'=>'Urganch']);
            Region::create(['name'=>'Urganch tuman']);
            Region::create(['name'=>'Xonqa']);
            Region::create(['name'=>'Bog\'ot']);
            Region::create(['name'=>'Xazorasp']);
            Region::create(['name'=>'Qo\'shko\'pir']);
            Region::create(['name'=>'Xiva']);
            Region::create(['name'=>'Xiva tuman']);
            Region::create(['name'=>'Yangiariq']);
            Region::create(['name'=>'Yangibozor']);
            Region::create(['name'=>'Gurlan']);
            Region::create(['name'=>'Shovot']);
            Region::create(['name'=>'Tuproqqal\'a']);
    }
}
