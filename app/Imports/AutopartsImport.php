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
            'product'     => array_key_exists(0, $row) ? (string) $row[0] : null,
            'name'        => array_key_exists(1, $row) ? $row[1] : null,
            'description' => array_key_exists(2, $row) ? $row[2] : null,
            'brand'       => array_key_exists(3, $row) ? $row[3] : null,
            'model'       => array_key_exists(4, $row) ? $row[4] : null,
            'origin'      => array_key_exists(5, $row) ? $row[5] : null,
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
