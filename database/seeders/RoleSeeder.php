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

        //Se asigna los roles a los permisos
        Permission::create(['name' => 'admin.home', 'description' => 'Ver el dashboard'])->syncRoles([$role1, $role2]);

        //Permisos para users
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.users.update', 'description' => ''])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Asignar un rol'])->syncRoles([$role1]);

        //Permisos para Categorias
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver listado de categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Crear categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar categorías'])->syncRoles([$role1]);

        //Permisos para Tags
        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver listado de etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create', 'description' => 'Crear etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description' => 'Editar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description' => 'Eliminar etiquetas'])->syncRoles([$role1]);

        //Permisos para Posts
        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver listado de Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'description' => 'Crear Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description' => 'Editar Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description' => 'Eliminar Posts'])->syncRoles([$role1, $role2]);

        //Se cambio o asigno permisos a admin.catetories.index y admin.catetories.tags a admin y blogger
        //De nuevo a correr la migrate y seeders
    }
}
