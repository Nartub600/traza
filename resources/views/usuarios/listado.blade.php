@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Usuarios</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de Usuarios
    <a href="{{ route('usuarios.create') }}" class="uppercase btn btn-success">
      Nuevo usuario
    </a>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE COMPLETO</th>
        <th>CORREO ELECTRÓNICO</th>
        <th>PERFILES</th>
        <th>GRUPOS</th>
        <th>USUARIO</th>
        <th>ACTUALIZADO</th>
        <th>ESTADO</th>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->roles->map->name->implode(', ') }}</td>
        <td>{{ $user->groups->map->name->implode(', ') }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->updated_at }}</td>
        <td>{{ $user->active ? 'Activo' : 'Inactivo' }}</td>
        <td>
          <div class="flex items-center">
            @can('ver usuarios')
            <a href="{{ route('usuarios.show', $user->id) }}" class="mx-2 my-0 p-0">
              <i class="fa fa-eye"></i>
            </a>
            @endcan
            @can('editar usuarios')
            <a href="{{ route('usuarios.edit', $user->id) }}" class="mx-2 my-0 p-0">
              <i class="fa fa-edit"></i>
            </a>
            @endcan
            @can('eliminar usuarios')
            <a
              class="mx-2 my-0 p-0"
              href="{{ route('usuarios.destroy', $user->id) }}"
              onclick="confirmDelete(event, {{ $user }})"
            >
                <i class="fa fa-times"></i>
            </a>
            <form id="delete-form-{{ $user->id }}" action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>
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

  function confirmDelete(event, user)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${user.username}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${user.id}`).submit()
      }
    })
  }
</script>
@endpush
