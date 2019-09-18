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

    public function create()
    {
        $this->authorize('crear', Traza::class);

        return view('trazas.crear');
    }

    public function store(CreateTrazaRequest $request)
    {
        $this->authorize('crear', Traza::class);

        $traza = new Traza($request->validated());

        $traza->save();

        return redirect()->route('trazas.index');
    }
}
