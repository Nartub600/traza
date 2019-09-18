<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLCMRequest;
use App\Http\Requests\UpdateLCMRequest;
use App\LCM;
use Illuminate\Http\Request;

class LCMController extends Controller
{
    public function index()
    {
        $this->authorize('listar', LCM::class);

        $lcms = LCM::all();

        return view('lcms.listado', compact('lcms'));
    }

    public function create()
    {
        $this->authorize('crear', LCM::class);

        return view('lcms.crear');
    }

    public function store(CreateLCMRequest $request)
    {
        $this->authorize('crear', LCM::class);

        $lcm = new LCM($request->validated());

        $lcm->user()->associate($request->user());

        $lcm->save();

        return redirect()->route('lcms.index');
    }

    public function show($id)
    {
        $this->authorize('ver', LCM::class);

        $lcm = LCM::with('user')->findOrFail($id);

        return view('lcms.ver', compact('lcm'));
    }

    public function edit($id)
    {
        $this->authorize('crear', LCM::class);

        $lcm = LCM::findOrFail($id);

        return view('lcms.editar', compact('lcm'));
    }

    public function update(UpdateLCMRequest $request, $id)
    {
        $this->authorize('editar', LCM::class);

        $lcm = LCM::findOrFail($id);
        $lcm->fill($request->validated());

        $lcm->save();

        return redirect()->route('lcms.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', LCM::class);

        $lcm = LCM::findOrFail($id);

        $lcm->delete();

        return redirect()->route('lcms.index');
    }
}
