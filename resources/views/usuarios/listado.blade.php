@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <h1 class="flex justify-between">
    Administrador de Usuarios
    <a href="{{ route('usuarios.create') }}" class="uppercase btn btn-success">
      Nuevo usuario
    </a>
  </h1>

  <hr class="my-4">

  {{-- <div class="flex justify-end">
    <div class="form-group item-form w-1/2">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Buscar por todos los datos">
        <span class="input-group-addon p-0 border-0">
          <button class="p-0 btn-info w-11 h-11 rounded-r">
            <i class="icono-arg-lupa btn-info"></i>
          </button>
        </span>
      </div>
    </div>
  </div> --}}

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
        <th><i class="fa fa-cog"></i></th>
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
          <a href="{{ route(auth()->user()->can('editar usuarios') ? 'usuarios.edit' : 'usuarios.show', $user->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    $('#tabla').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }
    })
  </script>
</div>

@endsection
