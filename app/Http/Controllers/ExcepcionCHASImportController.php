<?php

namespace App\Http\Controllers;

use App\Imports\ExcepcionCHASImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcepcionCHASImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $exchas = new ExcepcionCHASImport;
        Excel::import($exchas, $request->file('excel'));

        return $exchas->validator->validate();
    }
}
