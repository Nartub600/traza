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

        Permission::create(['name' => 'listar perfiles', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de perfiles']);
        Permission::create(['name' => 'crear perfiles', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de perfiles']);
        Permission::create(['name' => 'ver perfiles', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de perfiles']);
        Permission::create(['name' => 'editar perfiles', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de perfiles']);
        Permission::create(['name' => 'eliminar perfiles', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de perfiles']);

        Permission::create(['name' => 'listar usuarios', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de usuarios']);
        Permission::create(['name' => 'crear usuarios', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de usuarios']);
        Permission::create(['name' => 'ver usuarios', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de usuarios']);
        Permission::create(['name' => 'editar usuarios', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de usuarios']);
        Permission::create(['name' => 'eliminar usuarios', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de usuarios']);

        Permission::create(['name' => 'listar grupos', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de grupos']);
        Permission::create(['name' => 'crear grupos', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de grupos']);
        Permission::create(['name' => 'ver grupos', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de grupos']);
        Permission::create(['name' => 'editar grupos', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de grupos']);
        Permission::create(['name' => 'eliminar grupos', 'grupo' => 'seguridad', 'subgrupo' => 'administrador de grupos']);

        Permission::create(['name' => 'listar productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);
        Permission::create(['name' => 'crear productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);
        Permission::create(['name' => 'ver productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);
        Permission::create(['name' => 'editar productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);
        Permission::create(['name' => 'eliminar productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);
        Permission::create(['name' => 'exportar productos', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de productos']);

        Permission::create(['name' => 'listar lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);
        Permission::create(['name' => 'crear lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);
        Permission::create(['name' => 'ver lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);
        Permission::create(['name' => 'editar lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);
        Permission::create(['name' => 'eliminar lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);
        Permission::create(['name' => 'exportar lcm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcm']);

        Permission::create(['name' => 'listar catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);
        Permission::create(['name' => 'crear catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);
        Permission::create(['name' => 'ver catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);
        Permission::create(['name' => 'editar catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);
        Permission::create(['name' => 'eliminar catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);
        Permission::create(['name' => 'exportar catalogo', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de catalogo']);

        Permission::create(['name' => 'listar certificados', 'grupo' => 'certificados']);
        Permission::create(['name' => 'crear certificados', 'grupo' => 'certificados']);
        Permission::create(['name' => 'ver certificados', 'grupo' => 'certificados']);
        Permission::create(['name' => 'editar certificados', 'grupo' => 'certificados']);
        Permission::create(['name' => 'eliminar certificados', 'grupo' => 'certificados']);
        Permission::create(['name' => 'exportar certificados', 'grupo' => 'certificados']);

        Permission::create(['name' => 'listar trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'crear trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'exportar trazas', 'grupo' => 'trazas']);

        Role::create(['name' => 'administrador', 'active' => true])->syncPermissions(Permission::all());
        Role::create(['name' => 'certificador', 'active' => true])->syncPermissions(Permission::where('name', 'like', '%certificados')->get());
        Role::create(['name' => 'fabricante', 'active' => true]);
    }
}
