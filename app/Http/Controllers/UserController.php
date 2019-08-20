<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['groups', 'roles'])->get();

        return view('usuarios.listado', compact('users'));
    }

    public function create()
    {
        $groups = Group::all();
        $roles = Role::all();

        return view('usuarios.crear', compact('groups', 'roles'));
    }

    public function show($id)
    {
        $user = User::with(['groups', 'roles'])->findOrFail($id);

        return view('usuarios.ver', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with(['groups', 'roles'])->findOrFail($id);

        $groups = Group::all();
        $roles = Role::all();

        return view('usuarios.editar', compact('user', 'groups', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = new User($request->validated());
        $user->password = Hash::make($request->password);

        $user->save();

        $user->groups()->attach($request->groups);
        $user->assignRole($request->roles);

        return redirect()->route('usuarios.index');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->fill($request->validated());
        $user->password = Hash::make($request->password);

        $user->save();

        $user->groups()->sync($request->groups);
        $user->syncRoles($request->roles);

        return redirect()->route('usuarios.index');
    }
}
