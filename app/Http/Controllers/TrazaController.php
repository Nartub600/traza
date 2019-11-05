<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Http\Requests\CreateTrazaRequest;
use App\LCM;
use App\Traza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrazaController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Traza::class);

        $trazas = Traza::all();

        return view('trazas.listado', compact('trazas'));
    }

    public function show($id)
    {
        $this->authorize('ver', Traza::class);

        $traza = Traza::findOrFail($id);

        return view('trazas.ver', compact('traza'));
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
        $uuid = Str::uuid();
        $traza->uuid = $uuid;

        // todo: mejorar esto
        $files = [];

        foreach($request->documents as $key => $field) {
            if (is_array($field)) { // puede haber varios archivos del mismo tipo: documents[foto][$i]
                foreach($field as $file) {
                    $savedName = $file->store('documents/' . $uuid, 'public');
                    $fileData = [
                        'name' => $file->getClientOriginalName(),
                        'file' => $savedName,
                        'type' => $key
                    ];
                    array_push($files, $fileData);
                }
            } else {
                $savedName = $field->store('documents/' . $uuid, 'public');
                $fileData = [
                    'name' => $field->getClientOriginalName(),
                    'file' => $savedName,
                    'type' => $key
                ];
                array_push($files, $fileData);
            }
        }

        $traza->files = $files;
        // esto

        $traza->save();

        switch ($request->type) {
            case 'cape':
                DB::transaction(function () use ($request, $traza) {
                    foreach ($request->lcms as $lcm) {
                        $matchedLcm = LCM::where('number', $lcm['lcm'])
                            ->where('brand', $lcm['brand'])
                            ->where('model', $lcm['model'])
                            ->where('country', $lcm['country'])
                            ->whereNull('cape')
                            ->first();

                        $matchedLcm->generarCAPE($lcm['product']);
                        $matchedLcm->traza()->associate($traza);

                        $matchedLcm->save();
                    }
                });
            break;
            case 'chas':
                DB::transaction(function () use ($request, $traza) {
                    foreach ($request->autoparts as $autopart) {
                        $matchedAutopart = Autopart::where('brand', $autopart['brand'])
                            ->where('model', $autopart['model'])
                            ->where('origin', $autopart['origin'])
                            ->whereNull('chas')
                            ->first();

                        $matchedAutopart->generarChas();
                        $matchedAutopart->certificate->traza()->associate($traza);

                        $matchedAutopart->save();
                    }
                });
            break;
            case 'excepcion-chas':
                DB::transaction(function () use ($request, $traza) {
                    foreach ($request->autopart as $autopart) {
                        $newAutopart = new Autopart($autopart);
                        $newAutopart->traza()->associate($traza);

                        $newAutopart->save();
                    }
                });
            break;
        }

        return redirect()->route('trazas.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', Traza::class);

        $traza = Traza::findOrFail($id);

        $traza->delete();

        return redirect()->route('trazas.index');
    }
}
