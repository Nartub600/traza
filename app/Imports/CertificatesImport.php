<?php

namespace App\Imports;

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
            'family'        => (string) $row[3],
            'ncm_category'  => $row[4],
            'manufacturer'  => $row[5],
            'importer'      => $row[6],
            'business_name' => $row[7],
            'part_number'   => $row[8],
            'brand'         => $row[9],
            'model'         => $row[10],
            'origin'        => $row[11],
            'description'   => $row[12],
            'size'          => $row[13],
            'formulation'   => $row[14],
            'application'   => $row[15],
            'certified_at'  => $row[16],
            'license'       => $row[17],
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
