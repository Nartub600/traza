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

        if ($chas->validator->passes()) {
            foreach ($chas->validator->valid() as $autopart) {
                $matchedAutopart = Autopart::where('brand', $autopart['brand'])
                    ->where('model', $autopart['model'])
                    ->where('origin', $autopart['origin'])
                    ->whereNull('chas')
                    ->first();

                $matchedAutopart->generarCHAS();
                $matchedAutopart->save();
            }

            return;
        }

        return $chas->validator->validate();
    }
}
