<option
  value="{{ $p->id }}"
  @if (isset($product) && old('parent_id', $product->parent_id) === $p->id) selected @endif
  @if (isset($product) && $product->id === $p->id) disabled @endif
>
  {{ $p->category . ' ' . $p->name }}
</option>
@foreach ($p->children as $p)
  @include('productos.arbol', [ 'p' => $p, 'product' => $product ?? null ])
@endforeach
