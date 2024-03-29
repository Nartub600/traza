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
        $this->authorize('listar', Product::class);

        $products = Product::doesntHave('parent')->get();

        return view('productos.listado', compact('products'));
    }

    public function create()
    {
        $this->authorize('crear', Product::class);

        $products = Product::doesntHave('parent')->get();

        return view('productos.crear', compact('products'));
    }

    public function show($id)
    {
        $this->authorize('ver', Product::class);

        $product = Product::findOrFail($id);

        return view('productos.ver', compact('product'));
    }

    public function edit($id)
    {
        $this->authorize('editar', Product::class);

        $product = Product::findOrFail($id);

        $products = Product::doesntHave('parent')->get();

        return view('productos.editar', compact('product', 'products'));
    }

    public function store(CreateProductRequest $request)
    {
        $this->authorize('crear', Product::class);

        $product = new Product($request->validated());
        $product->user()->associate($request->user());

        if ($request->filled('parent_id')) {
            $parent = Product::findOrFail($request->parent_id);
            $product->parent()->associate($parent);
            $product->subindex = $parent->children()->withTrashed()->count() + 1;
        }

        $product->save();

        return redirect()->route('productos.index');
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->authorize('editar', Product::class);

        $product = Product::findOrFail($id);
        $product->fill($request->validated());

        $product->save();

        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar', Product::class);

        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('productos.index');
    }
}
