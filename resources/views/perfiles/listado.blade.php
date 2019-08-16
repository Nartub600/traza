@extends('layouts.default')

@section('content')
<div class="container-fluid">
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
        <th><i class="fa fa-cog"></i></th>
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
        <td>
          <a href="{{ route(auth()->user()->can('editar perfiles') ? 'perfiles.edit' : 'perfiles.show', $role->id) }}" class="btn m-0 p-0">
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
