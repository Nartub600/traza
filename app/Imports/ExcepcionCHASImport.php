<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\MatchesAutopart;
use App\Rules\MatchesProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExcepcionCHASImport implements ToCollection, WithStartRow, WithMultipleSheets, WithMapping
{
    public function collection(Collection $rows)
    {
        $sanitized = $rows->reject(function ($row) {
            return is_null($row['product']);
        });

        $validator = Validator::make($sanitized->toArray(), [
            '*'               => [
                'bail',
                new MatchesProduct,
            ],
            '*.cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
            '*.manufacturer'  => 'required',
            '*.business_name' => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.size'          => 'required',
            '*.description'   => 'required',
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
            'size'          => $row[9],
            'description'   => $row[10],
            'pictures'      => $row[11] ? implode(',', array_map('trim', explode(',', $row[11]))) : null,
        ];
    }
}
