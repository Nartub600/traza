<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('productos.listado', compact('products'));
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->save();

        return redirect()->route('productos.index');
    }
}
