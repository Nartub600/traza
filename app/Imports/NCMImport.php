<?php

namespace App\Imports;

use App\NCM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NCMImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NCM([
            'category' => $row[0],
            'description' => $row[1],
            'active' => true,
        ]);
    }

    public function startRow(): int
    {
        return 4;
    }
}
