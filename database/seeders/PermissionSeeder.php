<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            ['name' => 'Dashboard', 'permissions' => ['Show']],
            ['name' => 'Role', 'permissions' => ['Create', 'Show', 'Edit', 'Delete']],
            ['name' => 'Permission', 'permissions' => ['Show']],
            ['name' => 'Customer', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'User', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Product', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Quote', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Invoice', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Order', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Artwork', 'permissions' => ['Create', 'Show', 'Edit', 'Delete', 'Export']],
            ['name' => 'Setting', 'permissions' => ['Edit']],
        ];

        foreach ($modules as $module) {
            $mod = Module::updateOrCreate(['name' => $module['name']]);

            foreach ($module['permissions'] as $permission) {
                $mod->permissions()->updateOrCreate([
                    'name' => "$permission {$module['name']}",
                    'slug' => strtolower($permission) . '_' . strtolower(str_replace(' ', '_', $module['name']))
                ]);
            }
        }

        // Role::query()->find(1)->update(['permissions' => Permission::query()->pluck('slug')->toArray()]);
    }
}
