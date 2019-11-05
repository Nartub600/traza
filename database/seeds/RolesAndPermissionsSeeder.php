<?php

use App\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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

        Schema::disableForeignKeyConstraints();

        Permission::truncate();
        Role::truncate();

        Schema::enableForeignKeyConstraints();

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

        Permission::create(['name' => 'listar lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);
        Permission::create(['name' => 'crear lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);
        Permission::create(['name' => 'ver lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);
        Permission::create(['name' => 'editar lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);
        Permission::create(['name' => 'eliminar lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);
        Permission::create(['name' => 'exportar lcms', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de lcms']);

        Permission::create(['name' => 'listar ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);
        Permission::create(['name' => 'crear ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);
        Permission::create(['name' => 'ver ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);
        Permission::create(['name' => 'editar ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);
        Permission::create(['name' => 'eliminar ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);
        Permission::create(['name' => 'exportar ncm', 'grupo' => 'datos maestros', 'subgrupo' => 'administrador de ncm']);

        Permission::create(['name' => 'listar licencias', 'grupo' => 'licencias']);
        Permission::create(['name' => 'crear licencias', 'grupo' => 'licencias']);
        Permission::create(['name' => 'ver licencias', 'grupo' => 'licencias']);
        Permission::create(['name' => 'editar licencias', 'grupo' => 'licencias']);
        Permission::create(['name' => 'eliminar licencias', 'grupo' => 'licencias']);
        Permission::create(['name' => 'exportar licencias', 'grupo' => 'licencias']);

        Permission::create(['name' => 'listar trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'crear trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'ver trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'eliminar trazas', 'grupo' => 'trazas']);
        Permission::create(['name' => 'exportar trazas', 'grupo' => 'trazas']);

        Role::create(['name' => 'administrador', 'active' => true])->syncPermissions(Permission::all());
        Role::create(['name' => 'certificador', 'active' => true])->syncPermissions(Permission::where('name', 'like', '%licencias')->get());
        Role::create(['name' => 'fabricante', 'active' => true]);
    }
}
