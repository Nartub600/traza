<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AprobarExtranjeraController extends Controller
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

        if ($chas->validator->passes()) {
            foreach ($chas->validator->valid() as $autopart) {
                $autopart->generarCHAS();
                $autopart->save();
            }

            return;
        }

        return $chas->validator->validate();
    }
}
