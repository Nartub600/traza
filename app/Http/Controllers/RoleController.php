<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function store(CreateRoleRequest $request)
    {
        $role = Role::create([ 'name' => $request->name ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();

        $role->syncPermissions($permissions);
    }
}
