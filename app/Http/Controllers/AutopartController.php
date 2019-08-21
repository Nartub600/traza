<?php

namespace App\Http\Controllers;

use App\Autopart;
use App\Http\Requests\CreateAutopartRequest;
use App\Product;
use Illuminate\Http\Request;

class AutopartController extends Controller
{
    public function store(CreateAutopartRequest $request)
    {
        $autopart = new Autopart($request->validated());

        $product = Product::find($request->product_id);
        $autopart->product()->associate($product);

        $autopart->save();

        return $autopart->fresh();
    }
}
