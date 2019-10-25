<?php

namespace App\Http\Controllers;

use App\Imports\CAPEImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CAPEImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cape = new CAPEImport;
        Excel::import($cape, $request->file('excel'));

        return $cape->validator->validate();
    }
}
