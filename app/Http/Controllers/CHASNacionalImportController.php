<?php

namespace App\Http\Controllers;

use App\Imports\CHASNacionalImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CHASNacionalImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $chas = new CHASNacionalImport;
        Excel::import($chas, $request->file('excel'));

        return $chas->validator->validate();
    }
}
