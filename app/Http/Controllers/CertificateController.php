<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Certificate::class);

        $certificates = Certificate::withCount('autoparts')->get();

        return view('certificados.listado', compact('certificates'));
    }

    public function create()
    {
        $this->authorize('crear', Certificate::class);

        $products = Product::all();

        return view('certificados.crear', compact('products'));
    }

    public function show($id)
    {
        $this->authorize('ver', Certificate::class);

        $certificate = Certificate::with('autoparts', 'autoparts.product')->findOrFail($id);

        return view('certificados.ver', compact('certificate'));
    }

    public function edit($id)
    {
        $this->authorize('editar', Certificate::class);

        $certificate = Certificate::with('autoparts', 'autoparts.product')->findOrFail($id);

        $products = Product::all();

        return view('certificados.editar', compact('certificate', 'products'));
    }

    public function store(CreateCertificateRequest $request)
    {
        $this->authorize('crear', Certificate::class);

        $certificate = new Certificate($request->validated());
        $certificate->user()->associate($request->user());

        $autoparts = collect($request->autoparts)
            ->map(function ($autopart) { return json_decode($autopart, true); })
            ->mapInto(Autopart::class);

        DB::transaction(function () use ($certificate, $autoparts) {
            $certificate->save();
            $certificate->autoparts()->saveMany($autoparts);
        });

        return redirect()->route('certificados.index');
    }

    public function update(UpdateCertificateRequest $request, $id)
    {
        $this->authorize('editar', Certificate::class);

        $certificate = Certificate::findOrFail($id);
        $certificate->fill($request->validated());

        $autoparts = collect($request->autoparts)
            ->map(function ($autopart) { return json_decode($autopart, true); })
            ->mapInto(Autopart::class);

        DB::transaction(function () use ($certificate, $autoparts) {
            $certificate->save();
            $certificate->autoparts()->delete();
            $certificate->autoparts()->saveMany($autoparts);
        });

        return redirect()->route('certificados.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', Certificate::class);

        $certificate = Certificate::findOrFail($id);

        $certificate->delete();

        return redirect()->route('certificados.index');
    }
}
