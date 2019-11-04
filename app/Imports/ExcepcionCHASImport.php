<?php

namespace App\Imports;

use App\Rules\IsNCM;
use App\Rules\MatchesAutopart;
use App\Rules\MatchesProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcepcionCHASImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $validator = Validator::make($rows->toArray(), [
            '*'               => [new MatchesAutopart, new MatchesProduct],
            '*.product'       => '',
            '*.family'        => '',
            '*.cuit'          => ['required', 'regex:/[0-9]{2}-[0-9]{6,8}-[0-9]/'],
            '*.manufacturer'  => 'required',
            '*.business_name' => 'required',
            '*.ncm'           => ['required', new IsNCM],
            '*.brand'         => 'required',
            '*.model'         => 'required',
            '*.origin'        => ['required', Rule::in(['Argentina'])],
            '*.size'          => 'required',
            '*.description'   => 'required',
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
            'family'        => $row[1],
            'cuit'          => $row[2],
            'manufacturer'  => $row[3],
            'business_name' => $row[4],
            'ncm'           => $row[5],
            'brand'         => $row[6],
            'model'         => $row[7],
            'origin'        => $row[8],
            'size'          => $row[9],
            'description'   => $row[10],
        ];
    }
}
