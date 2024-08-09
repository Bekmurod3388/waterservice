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
        $admin->syncPermissions(Permission::query()
            ->whereIn('name',[
                'dashboard', 'all_clients', 'create_client', 'edit_client', 'client_points', 'client_tasks', 'work_list', 'work_change_expire', 'create_task', 'all_agents', 'all_users', 'all_services', 'all_products', 'show_map', 'show_log'
            ])
            ->pluck('id'));

        $manager = Role::findOrCreate('manager');
        $manager->syncPermissions(
            Permission::query()
                ->whereIn('name',[
                    'dashboard', 'own_clients', 'create_client', 'client_tasks', 'client_points', 'all_products', 'show_map', 'show_log', 'all_services', 'all_agents', 'work_list', 'work_change_expire'
                ])
                ->pluck('id')
        );

        // Sotuv operatori
        $operatorDealer = Role::findOrCreate('operator_dealer');
        $operatorDealer->syncPermissions(
            Permission::query()
                ->whereIn('name',[
                    'dashboard', 'all_clients', 'own_clients', 'create_client', 'client_points', 'client_tasks'
                ])
                ->pluck('id')
        );

        $operatorCashier = Role::findOrCreate('operator_cashier');//to'lov operatori
        $operatorCashier->syncPermissions(
            Permission::query()
                ->whereIn('name',[
                    'dashboard', 'own_clients', 'create_client', 'client_points', 'all_clients', 'dashboard', 'work_list', 'all_agents', 'work_change_expire'
                ])
                ->pluck('id')
        );


        $operatorAgent = Role::findOrCreate('operator_agent');//servis operatori
        $operatorAgent->syncPermissions(
            Permission::query()
                ->whereIn('name',[
                    'dashboard', 'all_clients', 'create_client', 'client_points', 'work_list', 'all_agents', 'work_change_expire'
                ])
                ->pluck('id')
        );

        $dealer= Role::findOrCreate('dealer');//diller
        $agent = Role::findOrCreate('agent');//servischik
        $cashier = Role::findOrCreate('cashier');//kassir
    }
}
