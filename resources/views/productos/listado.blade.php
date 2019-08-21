@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Productos</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de productos
    <a href="{{ route('productos.create') }}" class="uppercase btn btn-success">
      Nuevo producto
    </a>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>FAMILIA</th>
        <th>USUARIO</th>
        <th>ACTUALIZACIÓN</th>
        <th>ESTADO</th>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->family }}</td>
        <td>{{ optional($product->user)->username }}</td>
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
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@push('scripts')
<script>
  $('#tabla').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    }
  })
</script>
@endpush
