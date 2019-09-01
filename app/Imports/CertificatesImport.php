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
            'number'      => (string) $row[0],
            'cuit'        => $row[1],
            'product'     => (string) $row[2],
            'name'        => $row[3],
            'description' => $row[4],
            'brand'       => $row[5],
            'model'       => $row[6],
            'origin'      => $row[7]
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
