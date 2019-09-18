@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Trazas</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de Trazas
    <div>
      @can('exportar trazas')
      <button type="button" class="btn btn-success uppercase mx-2" onclick="exportarTrazas()">
        Exportar Excel
      </button>
      @endcan
      @can('crear trazas')
      <a href="{{ route('trazas.create') }}" class="uppercase btn btn-success">
        Nueva traza
      </a>
      @endcan
    </div>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>NÚMERO</td>
        <td>CREADO</td>
      </tr>
    </thead>

    <tbody>
      @foreach ($trazas as $traza)
      <tr>
        <td>{{ $traza->id }}</td>
        <td>{{ $traza->number }}</td>
        <td>{{ $traza->created_at }}</td>
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

  function exportarTrazas () {
    Swal.fire({
      type: 'info',
      text: 'En construcción'
    })
  }
</script>
@endpush
