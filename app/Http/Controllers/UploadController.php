<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->picture->store('autopartes', 'public');

        return asset(Storage::url($path));
    }
}
