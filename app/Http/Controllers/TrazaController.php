<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrazaRequest;
use App\Traza;
use Illuminate\Http\Request;

class TrazaController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Traza::class);

        $trazas = Traza::all();

        return view('trazas.listado', compact('trazas'));
    }

    public function create($type)
    {
        $this->authorize('crear', Traza::class);

        if (!in_array($type, ['chas', 'cape', 'excepcion-chas'])) abort(404);

        return view('trazas.crear', compact('type'));
    }

    public function store(CreateTrazaRequest $request)
    {
        $this->authorize('crear', Traza::class);

        $traza = new Traza($request->validated());

        $traza->save();

        return redirect()->route('trazas.index');
    }
}
