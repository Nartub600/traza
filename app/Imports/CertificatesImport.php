<?php

namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CertificatesImport implements WithMapping, WithStartRow
{
    use Importable;

    public function map($row): array
    {
        return [
            'number'        => (string) $row[0],
            'cuit'          => $row[1],
            'product'       => (string) $row[2],
            'ncm'           => $row[3],
            'manufacturer'  => $row[4],
            'importer'      => $row[5],
            'business_name' => $row[6],
            'part_number'   => $row[7],
            'brand'         => $row[8],
            'model'         => $row[9],
            'origin'        => $row[10],
            'description'   => $row[11],
            'size'          => $row[12],
            'formulation'   => $row[13],
            'application'   => $row[14],
            'certified_at'  => (new Carbon('1899/12/31'))->addDays($row[15])->format('Y-m-d'),
            'license'       => $row[16],
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
