<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Roles
            'view-rol',
            'create-rol',
            'show-rol',
            'edit-rol',
            'delete-rol',
            // Blogs
            'view-blog',
            'create-blog',
            'show-blog',
            'edit-blog',
            'delete-blog',
            // Users
            'view-user',
            'create-user',
            'show-user',
            'edit-user',
            'delete-user',
        ];
        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }
    }
}
