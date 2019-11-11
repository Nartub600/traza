<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Http\Requests\AprobarTrazaRequest;
use App\Http\Requests\CreateTrazaRequest;
use App\LCM;
use App\NCM;
use App\Product;
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

        DB::transaction(function () use ($request, $traza) {
            $traza->save();

            switch ($request->type) {
                case 'cape':
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
                break;
                case 'chas':
                    if (empty($request->documents['wp29'])) {
                        // nacional
                        foreach ($request->autoparts as $autopart) {
                            $matchedAutopart = Autopart::where('brand', $autopart['brand'])
                                ->where('model', $autopart['model'])
                                ->where('origin', $autopart['origin'])
                                ->whereNull('chas')
                                ->first();

                            $matchedAutopart->generarChas();
                            $matchedAutopart->traza()->associate($traza);
                            $matchedAutopart->pictures = explode(',', $autopart['pictures']);
                            $matchedAutopart->save();

                            $matchedAutopart->certificate->traza()->associate($traza);
                            $matchedAutopart->certificate->save();
                        }
                    } else {
                        // extranjero
                        foreach ($request->autoparts as $autopart) {
                            $newAutopart = new Autopart($autopart);
                            $newAutopart->traza()->associate($traza);
                            $newAutopart->pictures = explode(',', $autopart['pictures']);

                            $category = implode('.', array_filter([$autopart['product'], $autopart['family']]));
                            $product = Product::findByCategory($category);
                            $newAutopart->product()->associate($product);

                            $ncm = NCM::findByCategory($autopart['ncm']);
                            $newAutopart->ncm()->associate($ncm);

                            $newAutopart->save();
                        }
                    }
                break;
                case 'excepcion-chas':
                    foreach ($request->autopart as $autopart) {
                        $newAutopart = new Autopart($autopart);
                        $newAutopart->traza()->associate($traza);

                        $newAutopart->save();
                    }
                break;
            }
        });

        return redirect()->route('trazas.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', Traza::class);

        $traza = Traza::findOrFail($id);

        $traza->delete();

        return redirect()->route('trazas.index');
    }

    public function export($id)
    {
        $this->authorize('exportar', Traza::class);

        $traza = Traza::findOrFail($id);

        if ($traza->items->isNotEmpty()) {
            if (file_exists("{$traza->number}.zip")) unlink("{$traza->number}.zip");
            $zip = new \ZipArchive;
            $zip->open("{$traza->number}.zip", \ZipArchive::CREATE);

            foreach ($traza->items as $item) {
                $name = $item instanceof Autopart ? $item->chas : $item->cape;
                $zip->addFromString("{$traza->number}/$name.png", $item->qr);
            }

            $zip->close();

            return response()->download("{$traza->number}.zip");
        }

        abort(404);
    }

    // esto por ahora acá
    public function aprobar(AprobarTrazaRequest $request, $id)
    {
        $this->authorize('crear', Traza::class);

        $traza = Traza::findOrFail($id);

        foreach ($request->autoparts as $autopart) {
            $matchedAutopart = Autopart::where('brand', $autopart['brand'])
                ->where('model', $autopart['model'])
                ->where('origin', $autopart['origin'])
                ->whereNull('chas')
                ->first();

            $matchedAutopart->generarCHAS();
            $matchedAutopart->save();
        }
    }
}
