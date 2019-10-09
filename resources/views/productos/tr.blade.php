<tr>
  <td>{{ $product->category }}</td>
  <td>{{ $product->name }}</td>
  {{-- <td>
    @includeWhen($product->parent, 'productos.ruta', [ 'product' => $product->parent ])
  </td> --}}
  {{-- <td>{{ optional($product->user)->username }}</td> --}}
  <td>{{ $product->updated_at }}</td>
  <td>{{ $product->active ? 'Activo' : 'Inactivo' }}</td>
  <td>
    <div class="flex items-center">
      @can('ver productos')
      <a href="{{ route('productos.show', $product->id) }}" class="mx-2 my-0 p-0">
        <i class="fa fa-eye"></i>
      </a>
      @endcan
      @can('editar productos')
      <a href="{{ route('productos.edit', $product->id) }}" class="mx-2 my-0 p-0">
        <i class="fa fa-edit"></i>
      </a>
      @endcan
      @can('eliminar productos')
      <a
        class="mx-2 my-0 p-0"
        href="{{ route('productos.destroy', $product->id) }}"
        onclick="confirmDelete(event, {{ $product }})"
      >
          <i class="fa fa-times"></i>
      </a>
      <form id="delete-form-{{ $product->id }}" action="{{ route('productos.destroy', $product->id) }}" method="POST" style="display: none;">
          @csrf
          @method('delete')
      </form>
      @endcan
    </div>
  </td>
</tr>
@foreach ($product->children as $child)
  @include('productos.tr', [ 'product' => $child ])
@endforeach
