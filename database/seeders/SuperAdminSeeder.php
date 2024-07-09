<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Joserph',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789')
        ]);

        $rol = Role::create(['name' => 'Admin']);

        $permission = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permission);

        $user->assignRole([$rol->id]);
    }
}
