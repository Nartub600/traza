<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();

        return view('perfiles.listado', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('perfiles.crear', compact('permissions'));
    }

    public function show($id)
    {
        $role = $role = Role::findById($id);
        $role->load('permissions');

        return view('perfiles.ver', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $role->load('permissions');

        $permissions = Permission::all();

        return view('perfiles.editar', compact('role', 'permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $role = Role::create([ 'name' => $request->name ]);

        $permissions = Permission::find($request->input('permissions', []));
        $role->syncPermissions($permissions);

        return redirect()->route('perfiles.index');
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findById($id);

        $role->name = $request->name;
        $role->save();

        $permissions = Permission::find($request->input('permissions', []));
        $role->syncPermissions($permissions);

        return redirect()->route('perfiles.index');
    }
}
