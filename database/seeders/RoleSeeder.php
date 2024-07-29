<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('manager');
        Role::findOrCreate('operator-dealer');//sotuv operatori
        Role::findOrCreate('operator-agent');//servis operatori
        Role::findOrCreate('operator-cashier');//to'lov operatori
        Role::findOrCreate('dealer');//diller
        Role::findOrCreate('agent');//servischik
        Role::findOrCreate('cashier');//kassir
    }
}
