<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('users')->get();

        return view('grupos.listado', compact('groups'));
    }

    public function create()
    {
        $users = User::all();

        return view('grupos.crear', compact('users'));
    }

    public function show($id)
    {
        $group = Group::with('users')->findOrFail($id);

        return view('grupos.ver', compact('group'));
    }

    public function edit($id)
    {
        $group = Group::with('users')->findOrFail($id);

        $users = User::all();

        return view('grupos.editar', compact('group', 'users'));
    }

    public function store(CreateGroupRequest $request)
    {
        $group = new Group($request->validated());

        $group->save();

        $group->users()->attach($request->users);

        return redirect()->route('grupos.index');
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);

        $group->fill($request->validated());
        $group->save();

        $group->users()->sync($request->users);

        return redirect()->route('grupos.index');
    }
}
