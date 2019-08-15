<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'listar perfiles']);
        Permission::create(['name' => 'crear perfiles']);
        Permission::create(['name' => 'ver perfiles']);
        Permission::create(['name' => 'editar perfiles']);
        Permission::create(['name' => 'eliminar perfiles']);

        Permission::create(['name' => 'listar usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        Permission::create(['name' => 'listar grupos']);
        Permission::create(['name' => 'crear grupos']);
        Permission::create(['name' => 'ver grupos']);
        Permission::create(['name' => 'editar grupos']);
        Permission::create(['name' => 'eliminar grupos']);

        Permission::create(['name' => 'listar productos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'editar productos']);
        Permission::create(['name' => 'eliminar productos']);
        Permission::create(['name' => 'exportar productos']);

        Permission::create(['name' => 'listar lcm']);
        Permission::create(['name' => 'crear lcm']);
        Permission::create(['name' => 'ver lcm']);
        Permission::create(['name' => 'editar lcm']);
        Permission::create(['name' => 'eliminar lcm']);
        Permission::create(['name' => 'exportar lcm']);

        Permission::create(['name' => 'listar catalogo']);
        Permission::create(['name' => 'crear catalogo']);
        Permission::create(['name' => 'ver catalogo']);
        Permission::create(['name' => 'editar catalogo']);
        Permission::create(['name' => 'eliminar catalogo']);
        Permission::create(['name' => 'exportar catalogo']);

        Permission::create(['name' => 'listar certificados']);
        Permission::create(['name' => 'crear certificados']);
        Permission::create(['name' => 'ver certificados']);
        Permission::create(['name' => 'editar certificados']);
        Permission::create(['name' => 'eliminar certificados']);
        Permission::create(['name' => 'exportar certificados']);

        Permission::create(['name' => 'listar trazas']);
        Permission::create(['name' => 'crear trazas']);
        Permission::create(['name' => 'exportar trazas']);

        Role::create(['name' => 'administrador'])->syncPermissions(Permission::all());
        Role::create(['name' => 'certificador']);
        Role::create(['name' => 'fabricante']);
    }
}
