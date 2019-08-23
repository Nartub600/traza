<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Product;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::withCount('autoparts')->get();

        return view('certificados.listado', compact('certificates'));
    }

    public function create()
    {
        $products = Product::all();

        return view('certificados.crear', compact('products'));
    }

    public function show($id)
    {
        $certificate = Certificate::with('autoparts', 'autoparts.product')->findOrFail($id);

        return view('certificados.ver', compact('certificate'));
    }

    public function edit($id)
    {
        $certificate = Certificate::with('autoparts', 'autoparts.product')->findOrFail($id);

        $products = Product::all();

        return view('certificados.editar', compact('certificate', 'products'));
    }

    public function store(CreateCertificateRequest $request)
    {
        $certificate = new Certificate($request->validated());

        $certificate->user()->associate($request->user());
        $certificate->save();

        $autoparts = collect($request->autoparts)
            ->map(function ($autopart) { return json_decode($autopart, true); })
            ->mapInto(Autopart::class);

        $certificate->autoparts()->saveMany($autoparts);

        return redirect()->route('certificados.index');
    }

    public function update(UpdateCertificateRequest $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $certificate->fill($request->validated());
        $certificate->save();

        $autoparts = collect($request->autoparts)
            ->map(function ($autopart) { return json_decode($autopart, true); })
            ->mapInto(Autopart::class);

        $certificate->autoparts()->delete();
        $certificate->autoparts()->saveMany($autoparts);

        return redirect()->route('certificados.index');
    }
}
