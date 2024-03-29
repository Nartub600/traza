<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('listar', User::class);

        $users = User::with(['groups', 'roles'])->get();

        return view('usuarios.listado', compact('users'));
    }

    public function create()
    {
        $this->authorize('crear', User::class);

        $groups = Group::active()->get();
        $roles = Role::active()->get();

        return view('usuarios.crear', compact('groups', 'roles'));
    }

    public function show($id)
    {
        $this->authorize('ver', User::class);

        $user = User::with(['groups', 'roles'])->findOrFail($id);

        return view('usuarios.ver', compact('user'));
    }

    public function edit($id)
    {
        $this->authorize('editar', User::class);

        $user = User::with(['groups', 'roles'])->findOrFail($id);

        $groups = Group::active()->get();
        $roles = Role::active()->get();

        return view('usuarios.editar', compact('user', 'groups', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $this->authorize('crear', User::class);

        $user = new User($request->validated());
        $user->password = Hash::make($request->password);

        DB::transaction(function () use ($user) {
            $user->save();
            $user->groups()->attach(request('groups'));
            $user->assignRole(request('roles'));
        });

        return redirect()->route('usuarios.index');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('editar', User::class);

        $user = User::findOrFail($id);
        $user->fill($request->validated());

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        DB::transaction(function () use ($user) {
            $user->save();
            $user->groups()->sync(request('groups'));
            $user->syncRoles(request('roles'));
        });

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', User::class);

        $user = User::findOrFail($id);

        if ($user->hasRole('administrador') && User::role('administrador')->count() === 1) {
            throw ValidationException::withMessages(['last_admin' => [
                'No se puede eliminar el último administrador'
            ]]);
        }

        $user->delete();

        return redirect()->route('usuarios.index');
    }
}
