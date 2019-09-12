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
            'number'      => array_key_exists(0, $row) ? (string) $row[0]: null,
            'cuit'        => array_key_exists(1, $row) ? $row[1]: null,
            'product'     => array_key_exists(2, $row) ? (string) $row[2]: null,
            'name'        => array_key_exists(3, $row) ? $row[3]: null,
            'description' => array_key_exists(4, $row) ? $row[4]: null,
            'brand'       => array_key_exists(5, $row) ? $row[5]: null,
            'model'       => array_key_exists(6, $row) ? $row[6]: null,
            'origin'      => array_key_exists(7, $row) ? $row[7]: null,
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
