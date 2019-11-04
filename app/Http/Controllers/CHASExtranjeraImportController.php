<?php

namespace App\Http\Controllers;

use App\Imports\CHASExtranjeraImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CHASExtranjeraImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $chas = new CHASExtranjeraImport;
        Excel::import($chas, $request->file('excel'));

        return $chas->validator->validate();
    }
}
