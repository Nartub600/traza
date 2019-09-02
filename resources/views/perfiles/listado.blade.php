@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Perfiles</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de Perfiles
    <a href="{{ route('perfiles.create') }}" class="uppercase btn btn-success">
      Nuevo perfil
    </a>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>NOMBRE DEL PERFIL</td>
        <td>CANTIDAD DE USUARIOS</td>
        <td>ACTUALIZADO</td>
        <td>ESTADO</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($roles as $role)
      <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>{{ $role->users_count }}</td>
        <td>{{ $role->updated_at }}</td>
        <td>{{ $role->active ? 'Activo' : 'Inactivo' }}</td>
        <td class="text-center">
          @can('ver perfiles')
          <a href="{{ route('perfiles.show', $role->id) }}" class="btn m-0 p-0">
            <i class="fa fa-eye"></i>
          </a>
          @endcan
          @can('editar perfiles')
          <a href="{{ route('perfiles.edit', $role->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
          @endcan
          @if (!$role->users_count)
            @can('eliminar perfiles')
              <a
                class="btn m-0 p-0"
                href="{{ route('perfiles.destroy', $role->id) }}"
                onclick="confirmDelete(event, {{ $role }})"
              >
                  <i class="fa fa-times"></i>
              </a>
              <form id="delete-form-{{ $role->id }}" action="{{ route('perfiles.destroy', $role->id) }}" method="POST" style="display: none;">
                  @csrf
                  @method('delete')
              </form>
              @endcan
            @endif
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

  function confirmDelete(event, role)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${role.name}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${role.id}`).submit()
      }
    })
  }
</script>
@endpush
