<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\LCM;
use Illuminate\Http\Request;

class QRInfoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $qr)
    {
        $lcm = LCM::findByCAPE($qr);
        if ($lcm) return $lcm;

        $autopart = Autopart::findByCHAS($qr);
        if ($autopart) return view('autopart', compact('autopart'));

        abort(404);
    }
}
