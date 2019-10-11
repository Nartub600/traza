<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Imports\AutopartsImport;
use App\Imports\CertificatesImport;
use App\NCM;
use App\Product;
use App\Rules\IsNCM;
use App\Rules\IsNotCertificate;
use App\Rules\IsProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function certificates(Request $request)
    {
        // sólo la primera hoja
        $rows = (new CertificatesImport)->toCollection($request->excel)[0];

        // terminar si hay más de 1000 filas
        if ($rows->count() > 1000) {
            return response()->json([
                'rows' => 'Se admiten 1000 autopartes como máximo'
            ], 422);
        }

        // validación de filas
        [$valid, $invalid, $unique] = $this->validateCertificateRows($rows);

        // agrupar por número de certificado
        $certificates = $this->groupRowsByNumber($unique);

        // chequear que cada certificado tenga un solo cuit
        [$loadable, $unloadable] = $this->validateCertificates($certificates);

        $certificates = $this->prepareCertificates($loadable);

        return response()->json([
            'rows' => [
                'valid' => $valid,
                'invalid' => $invalid,
                'unique' => $unique
            ],
            'certificates' => [
                'valid' => $certificates,
                'invalid' => $unloadable
            ]
        ]);
    }

    public function autoparts(Request $request)
    {
        // sólo la primera hoja
        $rows = (new AutopartsImport)->toCollection($request->excel)[0];

        if ($rows->count() > 100) {
            return response()->json([
                'rows' => 'Se admiten 100 autopartes como máximo'
            ], 422);
        }

        // validación de filas
        [$valid, $invalid, $unique] = $this->validateAutopartRows($rows);

        $autoparts = $this->prepareAutoparts($unique);

        return response()->json(compact('autoparts', 'valid', 'invalid'));
    }

    private function validateCertificateRows($rows)
    {
        $valid = collect([]);
        $invalid = collect([]);

        $rows->each(function ($row, $index) use ($valid, $invalid) {
            $validator = Validator::make($row->toArray(), [
                'number'        => ['required', 'max:20', new IsNotCertificate],
                'cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
                'product'       => ['required', new IsProduct],
                'ncm'           => ['required', new IsNCM],
                'description'   => 'required|max:255',
                'manufacturer'  => 'required|max:255',
                'importer'      => 'required|max:255',
                'business_name' => 'required|max:255',
                'part_number'   => 'required|max:255',
                'brand'         => 'required|max:255',
                'model'         => 'required|max:255',
                'origin'        => 'required|max:100',
                'size'          => 'required|max:255',
                'formulation'   => 'required|max:255',
                'application'   => 'required|max:255',
                'license'       => 'required|max:25',
                'certified_at'  => 'required|date|max:255',
            ]);

            $validator->passes()
            ? $valid->push($row)
            : $invalid->push([
                'row'    => $row,
                'errors' => $validator->errors(),
                'index'  => $index + 2
            ]);
        });

        $unique = $valid->unique(function ($row) {
            return $row['product'] . $row['description'] . $row['brand'] . $row['model'] . $row['origin'];
        });

        return [$valid, $invalid, $unique];
    }

    private function validateAutopartRows($rows)
    {
        $valid = collect([]);
        $invalid = collect([]);

        $rows->each(function ($row, $index) use ($valid, $invalid) {
            $validator = Validator::make($row->toArray(), [
                'product'       => ['required', new IsProduct],
                'ncm'           => ['required', new IsNCM],
                'description'   => 'required|max:255',
                'manufacturer'  => 'required|max:255',
                'importer'      => 'required|max:255',
                'business_name' => 'required|max:255',
                'part_number'   => 'required|max:255',
                'brand'         => 'required|max:255',
                'model'         => 'required|max:255',
                'origin'        => 'required|max:100',
                'size'          => 'required|max:255',
                'formulation'   => 'required|max:255',
                'application'   => 'required|max:255',
                'license'       => 'required|max:25',
                'certified_at'  => 'required|date|max:255',
            ]);

            $validator->passes()
            ? $valid->push($row)
            : $invalid->push([
                'row'    => $row,
                'errors' => $validator->errors(),
                'index'  => $index + 2
            ]);
        });

        $unique = $valid->unique(function ($row) {
            return $row['product'] . $row['description'] . $row['brand'] . $row['model'] . $row['origin'];
        });

        return [$valid, $invalid, $unique];
    }

    private function groupRowsByNumber($rows)
    {
        $grouped = $rows->groupBy(function ($row) {
            return $row->toArray()['number'];
        });

        return $grouped;
    }

    private function validateCertificates($certificates)
    {
        $loadable = collect([]);
        $unloadable = collect([]);

        $certificates->each(function ($autoparts) use ($loadable, $unloadable) {
            $cuit = $autoparts[0]['cuit'];

            // ver si se puede implementar Validator
            $sameNumber = $autoparts->every(function ($autopart) use ($cuit) {
                return $autopart['cuit'] === $cuit;
            });

            $sameNumber
            ? $loadable->push($autoparts)
            : $unloadable->push($autoparts);
        });

        return [$loadable, $unloadable];
    }

    private function prepareCertificates($groups)
    {
        $certificates = collect([]);

        $groups->each(function ($rows) use ($certificates) {
            $certificate = [
                'number' => $rows[0]['number'],
                'cuit' => $rows[0]['cuit'],
            ];

            $autoparts = $this->prepareAutoparts($rows);

            $certificates->push([
                'number' => $certificate['number'],
                'cuit' => $certificate['cuit'],
                'autoparts' => $autoparts,
            ]);
        });

        return $certificates;
    }

    private function prepareAutoparts($rows)
    {
        return $rows->map(function ($row) {
            $row = $row->toArray();

            $product = Product::where('category', $row['product'])->first();
            $row['product_id'] = $product->id;
            $row['product_string'] = $product->category . ' ' . $product->name;

            $ncm = NCM::where('category', $row['ncm'])->first();
            $row['ncm_id'] = $ncm->id;
            $row['ncm_string'] = $ncm->category . ' ' . $ncm->description;

            return $row;
        });
    }
}
