@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Certificados</li>
  </ol>

  <h1 class="flex justify-between">
    Certificados
    <div>
      <a href="#" class="uppercase btn btn-success">
        Carga desde Excel
      </a>
      @can('crear certificados')
      <a href="{{ route('certificados.create') }}" class="uppercase btn btn-success">
        Nuevo certificado
      </a>
      @endcan
    </div>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>NÚMERO CERTIFICADO</td>
        <td>CUIT</td>
        <td>CANTIDAD DE AUTOPARTES</td>
        <td>USUARIO</td>
        <td>ACTUALIZACIÓN</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($certificates as $certificate)
      <tr>
        <td>{{ $certificate->id }}</td>
        <td>{{ $certificate->number }}</td>
        <td>{{ $certificate->cuit }}</td>
        <td>{{ $certificate->autoparts_count }}</td>
        <td>{{ $certificate->user->username }}</td>
        <td>{{ $certificate->updated_at }}</td>
        <td class="text-center">
          @can('ver certificados')
          <a href="{{ route('certificados.show', $certificate->id) }}" class="btn m-0 p-0">
            <i class="fa fa-eye"></i>
          </a>
          @endcan
          @can('editar certificados')
          <a href="{{ route('certificados.edit', $certificate->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
          @endcan
          @can('eliminar certificados')
            <a
              class="mx-2 my-0 p-0"
              href="{{ route('certificados.destroy', $certificate->id) }}"
              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $certificate->id }}').submit();"
            >
                <i class="fa fa-times"></i>
            </a>
            <form id="delete-form-{{ $certificate->id }}" action="{{ route('certificados.destroy', $certificate->id) }}" method="POST" style="display: none;">
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
</script>
@endpush
