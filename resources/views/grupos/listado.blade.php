@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <h1 class="flex justify-between">
    Administrador de Grupo de Usuarios
    <a href="{{ route('grupos.create') }}" class="uppercase btn btn-success">
      Nuevo grupo de usuarios
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
        <td>ID</td>
        <td>NOMBRE DEL GRUPO DE USUARIOS</td>
        <td>USUARIOS</td>
        <td>ACTUALIZADO</td>
        <td>ESTADO</td>
        <th><i class="fa fa-cog"></i></th>
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
        <td>
          <a href="{{ route(auth()->user()->can('editar grupos') ? 'grupos.edit' : 'grupos.show', $group->id) }}" class="btn m-0 p-0">
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
