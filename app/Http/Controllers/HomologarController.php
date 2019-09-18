<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomologarRequest;
use App\Jobs\HomologarTrata;
use Illuminate\Http\Request;

class HomologarController extends Controller
{
    public function store(HomologarRequest $request)
    {
        HomologarTrata::dispatch($request->all());
    }
}
