<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('productos.listado', compact('products'));
    }

    public function create()
    {
        return view('productos.crear');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('productos.ver', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('productos.editar', compact('product'));
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->user()->associate($request->user());

        $product->save();

        return redirect()->route('productos.index');
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->validated());
        $product->save();

        return redirect()->route('productos.index');
    }
}
