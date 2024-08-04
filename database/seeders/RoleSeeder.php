<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::findOrCreate('admin');
        $admin->syncPermissions(Permission::query()->pluck('id'));

        $manager = Role::findOrCreate('manager');

        // Sotuv operatori
        $operatorDealer = Role::findOrCreate('operator_dealer');
        $operatorDealer->syncPermissions(
            Permission::query()
                ->whereIn('name',[
                    'own_clients', 'create_client'
                ])
                ->pluck('id')
        );


        $operatorAgent = Role::findOrCreate('operator_agent');//servis operatori
        $operatorCashier = Role::findOrCreate('operator_cashier');//to'lov operatori
        $dealer= Role::findOrCreate('dealer');//diller
        $agent = Role::findOrCreate('agent');//servischik
        $cashier = Role::findOrCreate('cashier');//kassir
    }
}
