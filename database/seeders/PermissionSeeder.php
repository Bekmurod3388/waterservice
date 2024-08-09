<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DASHBOARD
        Permission::query()->firstOrCreate(['name' => 'dashboard']);

        // CLIENTS
        Permission::query()->firstOrCreate(['name' => 'all_clients']);
        Permission::query()->firstOrCreate(['name' => 'own_clients']);
        Permission::query()->firstOrCreate(['name' => 'create_client']);
        Permission::query()->firstOrCreate(['name' => 'edit_client']);
        Permission::query()->firstOrCreate(['name' => 'client_points']);
        Permission::query()->firstOrCreate(['name' => 'client_tasks']);

        // WORK LIST
        Permission::query()->firstOrCreate(['name' => 'work_list']);
        Permission::query()->firstOrCreate(['name' => 'work_change_expire']);

        // TASKS
        Permission::query()->firstOrCreate(['name' => 'create_task']);

        // AGENTS
        Permission::query()->firstOrCreate(['name' => 'all_agents']);

        // USERS
        Permission::query()->firstOrCreate(['name' => 'all_users']);

        // SERVICES
        Permission::query()->firstOrCreate(['name' => 'all_services']);

        // PRODUCTS
        Permission::query()->firstOrCreate(['name' => 'all_products']);

        // MAP
        Permission::query()->firstOrCreate(['name' => 'show_map']);

        // LOG
        Permission::query()->firstOrCreate(['name' => 'show_log']);
    }
}
