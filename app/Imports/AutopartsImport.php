<?php

namespace App\Imports;

use Carbon\Carbon;
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
            'ncm'           => $row[1],
            'manufacturer'  => $row[2],
            'importer'      => $row[3],
            'business_name' => $row[4],
            'part_number'   => $row[5],
            'brand'         => $row[6],
            'model'         => $row[7],
            'origin'        => $row[8],
            'description'   => $row[9],
            'size'          => $row[10],
            'formulation'   => $row[11],
            'application'   => $row[12],
            'certified_at'  => (new Carbon('1899/12/31'))->addDays($row[13])->format('Y-m-d'),
            'license'       => $row[14],
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
