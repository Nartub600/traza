<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Role::class);

        $roles = Role::withCount('users')->get();

        return view('perfiles.listado', compact('roles'));
    }

    public function create()
    {
        $this->authorize('crear', Role::class);

        $permissions = Permission::all();

        return view('perfiles.crear', compact('permissions'));
    }

    public function show($id)
    {
        $this->authorize('ver', Role::class);

        $role = $role = Role::findById($id);
        $role->load('permissions');

        return view('perfiles.ver', compact('role'));
    }

    public function edit($id)
    {
        $this->authorize('editar', Role::class);

        $role = Role::findById($id);
        $role->load('permissions');

        $permissions = Permission::all();

        return view('perfiles.editar', compact('role', 'permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorize('crear', Role::class);

        $role = new Role($request->except('permissions'));
        $permissions = Permission::find($request->input('permissions', []));

        DB::transaction(function () use ($role, $permissions) {
            $role->save();
            $role->syncPermissions($permissions);
        });

        return redirect()->route('perfiles.index');
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $this->authorize('editar', Role::class);

        $role = Role::findById($id);
        $role->fill($request->except('permissions'));

        $permissions = Permission::find($request->input('permissions', []));

        DB::transaction(function () use ($role, $permissions) {
            $role->save();
            $role->syncPermissions($permissions);
        });

        return redirect()->route('perfiles.index');
    }
}
