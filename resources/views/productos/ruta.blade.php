{{ $product->name }} @if ($product->parent) / @endif
@includeWhen($product->parent, 'productos.ruta', [ 'product' => $product->parent ])
