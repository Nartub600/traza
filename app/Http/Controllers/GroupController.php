<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Group::class);

        $groups = Group::withCount('users')->get();

        return view('grupos.listado', compact('groups'));
    }

    public function create()
    {
        $this->authorize('crear', Group::class);

        $users = User::all();

        return view('grupos.crear', compact('users'));
    }

    public function show($id)
    {
        $this->authorize('ver', Group::class);

        $group = Group::with('users')->findOrFail($id);

        return view('grupos.ver', compact('group'));
    }

    public function edit($id)
    {
        $this->authorize('editar', Group::class);

        $group = Group::with('users')->findOrFail($id);

        $users = User::all();

        return view('grupos.editar', compact('group', 'users'));
    }

    public function store(CreateGroupRequest $request)
    {
        $this->authorize('crear', Group::class);

        $group = new Group($request->validated());

        DB::transaction(function () use ($group) {
            $group->save();
            $group->users()->attach(request()->users);
        });

        return redirect()->route('grupos.index');
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $this->authorize('editar', Group::class);

        $group = Group::findOrFail($id);
        $group->fill($request->validated());

        DB::transaction(function () use ($group) {
            $group->save();
            $group->users()->sync(request()->users);
        });

        return redirect()->route('grupos.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', Group::class);

        $group = Group::findOrFail($id);

        $group->delete();

        return redirect()->route('grupos.index');
    }
}
