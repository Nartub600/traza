<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\IsProduct;
use App\Rules\MatchesAutopart;
use App\Rules\MatchesProduct;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CHASExtranjeraImport implements ToCollection, WithStartRow, WithMultipleSheets, WithMapping
{
    public function collection(Collection $rows)
    {
        $sanitized = $rows->reject(function ($row) {
            return is_null($row['product']);
        });

        $validator = Validator::make($sanitized->toArray(), [
            '*'               => [
                'bail',
                new MatchesProduct
            ],
            '*.cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
            '*.manufacturer'  => 'required',
            '*.importer'      => 'required',
            '*.business_name' => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.origin'        => [Rule::notIn(['Argentina', 'argentina'])],
            '*.description'   => 'required',
            '*.size'          => 'required',
            '*.formulation'   => 'required',
            '*.application'   => 'required',
            '*.license'       => 'required',
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
            'product'       => $row[0],
            'family'        => $row[1],
            'cuit'          => $row[2],
            'manufacturer'  => $row[3],
            'importer'      => $row[4],
            'business_name' => $row[5],
            'ncm'           => $row[6],
            'brand'         => $row[7],
            'model'         => $row[8],
            'origin'        => $row[9],
            'description'   => $row[10],
            'size'          => $row[11],
            'formulation'   => $row[12],
            'application'   => $row[13],
            'license'       => $row[14],
            'certified_at'  => (new Carbon('1899/12/31'))->addDays($row[15])->format('Y-m-d'),
            'pictures'      => $row[16],
        ];
    }
}
