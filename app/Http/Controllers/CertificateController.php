<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\NCM;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    public function index()
    {
        $this->authorize('listar', Certificate::class);

        $user = request()->user();

        $certificates = Certificate::withCount('autoparts')->get();

        return view('certificados.listado', compact('certificates'));
    }

    public function create()
    {
        $this->authorize('crear', Certificate::class);

        $products = Product::active()->doesntHave('parent')->get();
        $ncm = NCM::active()->get();

        return view('certificados.crear', compact('products' , 'ncm'));
    }

    public function show($id)
    {
        $this->authorize('ver', Certificate::class);

        $certificate = Certificate::with('autoparts')->findOrFail($id);
        $products = Product::active()->doesntHave('parent')->get();
        $ncm = NCM::active()->get();

        return view('certificados.ver', compact('certificate', 'products', 'ncm'));
    }

    public function edit($id)
    {
        $this->authorize('editar', Certificate::class);

        $certificate = Certificate::with('autoparts')->findOrFail($id);

        $products = Product::active()->doesntHave('parent')->get();
        $ncm = NCM::active()->get();

        return view('certificados.editar', compact('certificate', 'products', 'ncm'));
    }

    public function store(CreateCertificateRequest $request)
    {
        $this->authorize('crear', Certificate::class);

        if ($request->has('certificates')) {
            // bulk import
            collect($request->certificates)->each(function ($certificate) {
                $autoparts = collect($certificate['autoparts'])
                    ->mapInto(Autopart::class);

                $certificate = new Certificate($certificate);
                $certificate->user()->associate(request()->user());

                DB::transaction(function () use ($certificate, $autoparts) {
                    $certificate->save();
                    $certificate->autoparts()->saveMany($autoparts);
                });
            });
        } else {
            // single
            $certificate = new Certificate($request->validated());
            $certificate->user()->associate($request->user());

            $autoparts = collect($request->autoparts)
                ->mapInto(Autopart::class);

            DB::transaction(function () use ($certificate, $autoparts) {
                $certificate->save();
                $certificate->autoparts()->saveMany($autoparts);
            });

            return redirect()->route('certificados.index');
        }
    }

    public function update(UpdateCertificateRequest $request, $id)
    {
        $this->authorize('editar', Certificate::class);

        $certificate = Certificate::findOrFail($id);
        $certificate->fill($request->validated());

        $autoparts = collect($request->autoparts)
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
