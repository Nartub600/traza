@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">NCM</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de NCM
    @can('crear ncm')
    <a href="{{ route('ncm.create') }}" class="uppercase btn btn-success">
      Nueva categoría
    </a>
    @endcan
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>CATEGORÍA</td>
        <td>DESCRIPCIÓN</td>
        <td>ESTADO</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($ncm as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->category }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->active ? 'Activo' : 'Inactivo' }}</td>
        <td class="text-center">
          @can('ver ncm')
          <a href="{{ route('ncm.show', $item->id) }}" class="btn m-0 p-0">
            <i class="fa fa-eye"></i>
          </a>
          @endcan
          @can('editar ncm')
          <a href="{{ route('ncm.edit', $item->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
          @endcan
          @can('eliminar ncm')
            <a
              class="btn m-0 p-0"
              href="{{ route('ncm.destroy', $item->id) }}"
              onclick="confirmDelete(event, {{ $item }})"
            >
                <i class="fa fa-times"></i>
            </a>
            <form id="delete-form-{{ $item->id }}" action="{{ route('ncm.destroy', $item->id) }}" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>
            @endcan
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

  function confirmDelete(event, ncm)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${ncm.description}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${ncm.id}`).submit()
      }
    })
  }
</script>
@endpush
