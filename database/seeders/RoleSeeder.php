<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::pluck('slug');

        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'deletable' => false],
        ];

        foreach ($roles as $role) {
            $rl = Role::updateOrCreate($role);

            $rl->update(['permissions' => $permissions]);

            $rl->admins()->updateOrCreate([
                'role_id'           => $rl->id,
                'name'              => $rl->name,
                'email'             => "$rl->slug@gmail.com",
                'phone'             => fake()->phoneNumber(),
                'email_verified_at' => now(),
                'password'          => bcrypt('12345678'),
                'remember_token'    => Str::random(10)
            ]);
        }
    }
}
