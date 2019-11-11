<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Imports\AprobarCHASExtranjeraImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AprobarCHASExtranjeraController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $chas = new AprobarCHASExtranjeraImport;
        Excel::import($chas, $request->file('excel'));

        return $chas->validator->validate();
    }
}
