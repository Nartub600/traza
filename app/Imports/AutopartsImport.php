<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AutopartsImport implements WithMapping, WithStartRow
{
    use Importable;

    public function map($row): array
    {
        return [
            'product'       => (string) $row[0],
            'family'        => (string) $row[1],
            'ncm_category'  => $row[2],
            'manufacturer'  => $row[3],
            'importer'      => $row[4],
            'business_name' => $row[5],
            'part_number'   => $row[6],
            'brand'         => $row[7],
            'model'         => $row[8],
            'origin'        => $row[9],
            'description'   => $row[10],
            'size'          => $row[11],
            'formulation'   => $row[12],
            'application'   => $row[13],
            'certified_at'  => $row[14],
            'license'       => $row[15],
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
