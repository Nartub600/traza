<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\IsProduct;
use App\Rules\MatchesLCM;
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
        $validator = Validator::make($rows->toArray(), [
            '*'               => [new MatchesLCM],
            '*.product'       => ['required', new IsProduct],
            '*.cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
            '*.manufacturer'  => 'required',
            '*.importer'      => 'required',
            '*.business_name' => 'required',
            '*.lcm'           => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.brand'         => 'required',
            '*.model'         => 'required',
            '*.country'       => 'required',
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
            'cuit'          => $row[1],
            'manufacturer'  => $row[2],
            'importer'      => $row[3],
            'business_name' => $row[4],
            'lcm'           => $row[5],
            'ncm'           => $row[6],
            'brand'         => $row[7],
            'model'         => $row[8],
            'country'       => $row[9],
            'description'   => $row[10],
            'application'   => $row[11],
            'size'          => $row[12],
        ];
    }
}
