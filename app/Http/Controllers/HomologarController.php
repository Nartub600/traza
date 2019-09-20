<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomologarRequest;
use App\Jobs\FinalizarHomologacion;
use App\Jobs\HomologarTrata;
use Illuminate\Http\Request;

class HomologarController extends Controller
{
    public function empezar(HomologarRequest $request)
    {
        HomologarTrata::dispatch($request->all());
    }

    public function finalizar(FinalizarRequest $request)
    {
        FinalizarHomologacion::dispatch($request->all);
    }
}
