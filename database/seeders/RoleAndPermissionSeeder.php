<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Sekbid Admin']);
        Role::create(['name' => 'Student']);

        // Assign Super Admin to existing admin user
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('Super Admin');
        } else {
            $admin = User::create([
                'name' => 'Super Admin OSIS',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('ferdinand123'),
            ]);
            $admin->assignRole('Super Admin');
        }
    }
}
