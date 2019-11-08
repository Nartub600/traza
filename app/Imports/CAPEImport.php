<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\IsProduct;
use App\Rules\MatchesLCM;
use App\Rules\MatchesProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CAPEImport implements ToCollection, WithStartRow, WithMultipleSheets, WithMapping
{
    public function collection(Collection $rows)
    {
        $sanitized = $rows->reject(function ($row) {
            return is_null($row['product']);
        });

        $validator = Validator::make($sanitized->toArray(), [
            '*'               => [
                'bail',
                new MatchesLCM,
                new MatchesProduct
            ],
            '*.cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
            '*.manufacturer'  => 'required',
            '*.importer'      => 'required',
            '*.business_name' => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.description'   => 'required',
            '*.application'   => 'required',
            '*.size'          => 'required',
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
            'product'       => $row[0],
            'family'        => $row[1],
            'cuit'          => $row[2],
            'manufacturer'  => $row[3],
            'importer'      => $row[4],
            'business_name' => $row[5],
            'lcm'           => $row[6],
            'ncm'           => $row[7],
            'brand'         => $row[8],
            'model'         => $row[9],
            'country'       => $row[10],
            'description'   => $row[11],
            'application'   => $row[12],
            'size'          => $row[13],
        ];
    }
}
