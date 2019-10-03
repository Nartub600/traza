<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNCMRequest;
use App\Http\Requests\UpdateNCMRequest;
use App\NCM;
use Illuminate\Http\Request;

class NCMController extends Controller
{
    public function index()
    {
        $this->authorize('listar', NCM::class);

        $ncm = NCM::all();

        return view('ncm.listado', compact('ncm'));
    }

    public function create()
    {
        $this->authorize('crear', NCM::class);

        return view('ncm.crear');
    }

    public function store(CreateNCMRequest $request)
    {
        $this->authorize('crear', NCM::class);

        $ncm = new NCM($request->validated());

        $ncm->save();

        return redirect()->route('ncm.index');
    }

    public function edit($id)
    {
        $this->authorize('editar', NCM::class);

        $ncm = NCM::findOrFail($id);

        return view('ncm.editar', compact('ncm'));
    }

    public function update(UpdateNCMRequest $request, $id)
    {
        $this->authorize('editar', NCM::class);

        $ncm = NCM::findOrFail($id);

        $ncm->fill($request->validated());

        $ncm->save();

        return redirect()->route('ncm.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', NCM::class);

        $ncm = NCM::findOrFail($id);

        $ncm->delete();

        return redirect()->route('ncm.index');
    }
}
