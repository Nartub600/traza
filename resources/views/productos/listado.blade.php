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
        {{-- <th>PADRE</th> --}}
        {{-- <th>USUARIO</th> --}}
        <th>ACTUALIZACIÓN</th>
        <th>ESTADO</th>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($products as $product)
        @include('productos.tr', [ 'product' => $product ])
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
    },
    order: []
  })

  function confirmDelete(event, product)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${product.name}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${product.id}`).submit()
      }
    })
  }
</script>
@endpush
