<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Certificate;
use App\Imports\AutopartsImport;
use App\Imports\CertificatesImport;
use App\Product;
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

        // validación de filas
        [$valid, $invalid] = $this->validateCertificateRows($rows);

        // agrupar por número de certificado
        $certificates = $this->groupRowsByNumber($valid);

        // chequear que cada certificado tenga un solo cuit
        [$loadable, $unloadable] = $this->validateCertificates($certificates);

        $certificates = $this->saveCertificates($loadable);

        return response()->json([
            'invalid' => [
                'rows' => $invalid,
                'certificates' => $unloadable
            ],
            'certificates' => $certificates
        ]);
    }

    public function autoparts(Request $request)
    {
        // sólo la primera hoja
        $rows = (new AutopartsImport)->toCollection($request->excel)[0];

        // validación de filas
        [$valid, $invalid] = $this->validateAutopartRows($rows);

        return response()->json(compact('valid', 'invalid'));
    }

    private function validateCertificateRows($rows)
    {
        $valid = collect([]);
        $invalid = collect([]);

        $rows->each(function ($row) use ($valid, $invalid) {
            $validator = Validator::make($row->toArray(), [
                'number'      => ['required', 'numeric', new IsNotCertificate],
                'cuit'        => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
                'product'     => ['required', new IsProduct],
                'name'        => 'required',
                'description' => 'required',
                'brand'       => 'required',
                'model'       => 'required',
                'origin'      => 'required',
            ]);

            $validator->passes()
            ? $valid->push($row)
            : $invalid->push([ 'row' => $row, 'errors' => $validator->errors() ]);
        });

        return [$valid, $invalid];
    }

    private function validateAutopartRows($rows)
    {
        $valid = collect([]);
        $invalid = collect([]);

        $rows->each(function ($row) use ($valid, $invalid) {
            $validator = Validator::make($row->toArray(), [
                'product'     => ['required', new IsProduct],
                'name'        => 'required',
                'description' => 'required',
                'brand'       => 'required',
                'model'       => 'required',
                'origin'      => 'required',
            ]);

            $validator->passes()
            ? $valid->push($row)
            : $invalid->push([ 'row' => $row, 'errors' => $validator->errors() ]);
        });

        return [$valid, $invalid];
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

            $sameNumber = $autoparts->every(function ($autopart) use ($cuit) {
                return $autopart['cuit'] === $cuit;
            });

            $sameNumber
            ? $loadable->push($autoparts)
            : $unloadable->push($autoparts);
        });

        return [$loadable, $unloadable];
    }

    private function saveCertificates($groups)
    {
        $certificates = collect([]);

        $groups->each(function ($rows) use ($certificates) {
            $certificate = new Certificate([
                'number' => $rows[0]['number'],
                'cuit' => $rows[0]['cuit']
            ]);

            auth()->user()->certificates()->save($certificate);

            $autoparts = $rows->map(function ($row) {
                $product = Product::where('id', $row['product'])->orWhere('name', $row['product'])->first();
                $row = $row->toArray();
                $row['product_id'] = $product->id;

                return $row;
            })->mapInto(Autopart::class);

            $certificate->autoparts()->saveMany($autoparts);

            $certificate->refresh();
            $certificate->load('autoparts');

            // $certificates->push([
            //     'number' => $certificate->number,
            //     'cuit' => $certificate->cuit,
            //     'autoparts' => $autoparts
            // ]);

            $certificates->push($certificate);
        });

        return $certificates;
    }
}
