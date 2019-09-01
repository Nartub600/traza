<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AutopartsImport implements WithMapping, WithStartRow, WithValidation
{
    use Importable;

    public function map($row): array
    {
        return [
            'product'     => (string) $row[0],
            'name'        => $row[1],
            'description' => $row[2],
            'brand'       => $row[3],
            'model'       => $row[4],
            'origin'      => $row[5]
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
