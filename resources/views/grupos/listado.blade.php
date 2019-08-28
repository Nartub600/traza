@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Grupos de Usuarios</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de Grupo de Usuarios
    @can('crear grupos')
    <a href="{{ route('grupos.create') }}" class="uppercase btn btn-success">
      Nuevo grupo de usuarios
    </a>
    @endcan
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>NOMBRE DEL GRUPO DE USUARIOS</td>
        <td>USUARIOS</td>
        <td>ACTUALIZADO</td>
        <td>ESTADO</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($groups as $group)
      <tr>
        <td>{{ $group->id }}</td>
        <td>{{ $group->name }}</td>
        <td>{{ $group->users_count }}</td>
        <td>{{ $group->updated_at }}</td>
        <td>{{ $group->active ? 'Activo' : 'Inactivo' }}</td>
        <td class="text-center">
          @can('ver grupos')
          <a href="{{ route('grupos.show', $group->id) }}" class="btn m-0 p-0">
            <i class="fa fa-eye"></i>
          </a>
          @endcan
          @can('editar grupos')
          <a href="{{ route('grupos.edit', $group->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
          @endcan
          @can('eliminar grupos')
            <a
              class="mx-2 my-0 p-0"
              href="{{ route('grupos.destroy', $group->id) }}"
              onclick="confirmDelete(event, {{ $group }})"
            >
                <i class="fa fa-times"></i>
            </a>
            <form id="delete-form-{{ $group->id }}" action="{{ route('grupos.destroy', $group->id) }}" method="POST" style="display: none;">
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

  function confirmDelete(event, grupo)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${grupo.name}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${grupo.id}`).submit()
      }
    })
  }
</script>
@endpush
