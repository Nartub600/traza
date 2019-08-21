<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Http\Requests\CreateCertificateRequest;
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
}
