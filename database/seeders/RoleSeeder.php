<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generando roles
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home']);

        //Permisos para Categorias
        Permission::create(['name' => 'admin.categories.index']);
        Permission::create(['name' => 'admin.categories.create']);
        Permission::create(['name' => 'admin.categories.edit']);
        Permission::create(['name' => 'admin.categories.destroy']);

        //Permisos para Tags
        Permission::create(['name' => 'admin.tags.index']);
        Permission::create(['name' => 'admin.tags.create']);
        Permission::create(['name' => 'admin.tags.edit']);
        Permission::create(['name' => 'admin.tags.destroy']);

        //Permisos para Posts
        Permission::create(['name' => 'admin.posts.index']);
        Permission::create(['name' => 'admin.posts.create']);
        Permission::create(['name' => 'admin.posts.edit']);
        Permission::create(['name' => 'admin.posts.destroy']);
    }
}
