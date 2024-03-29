<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\IsProduct;
use App\Rules\MatchesAutopart;
use App\Rules\MatchesCertificateCUIT;
use App\Rules\MatchesCertificateNumber;
use App\Rules\MatchesCertifier;
use App\Rules\MatchesCountry;
use App\Rules\MatchesProduct;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CHASNacionalImport implements ToCollection, WithStartRow, WithMultipleSheets, WithMapping
{
    public function collection(Collection $rows)
    {
        $sanitized = $rows->reject(function ($row) {
            return is_null($row['product']);
        });

        $validator = Validator::make($sanitized->toArray(), [
            '*' => [
                'bail',
                new MatchesCertificateNumber,
                new MatchesAutopart,
                new MatchesCertifier,
                new MatchesCertificateCUIT,
                new MatchesProduct,
                new MatchesCountry
            ],
            '*.manufacturer'  => 'required',
            '*.business_name' => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.description'   => 'required',
            '*.size'          => 'required',
            '*.formulation'   => 'required',
            '*.application'   => 'required',
            '*.certified_at'  => 'required',
        ], [], array_combine(range(0, 1000), range(2, 1002)));

        $this->validator = $validator;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

    public function map($row): array
    {
        return [
            'product'       => (string) $row[0],
            'family'        => (string) $row[1],
            'cuit'          => $row[2],
            'manufacturer'  => $row[3],
            'business_name' => $row[4],
            'ncm'           => $row[5],
            'brand'         => $row[6],
            'model'         => $row[7],
            'origin'        => $row[8],
            'description'   => $row[9],
            'size'          => $row[10],
            'formulation'   => $row[11],
            'application'   => $row[12],
            'license'       => $row[13],
            'certified_at'  => $row[14] ? (new Carbon('1899/12/31'))->addDays($row[14])->format('Y-m-d') : null,
            'certifier'     => $row[15],
            'pictures'      => $row[16] ? implode(',', array_map('trim', explode(',', $row[16]))) : null,
        ];
    }
}
