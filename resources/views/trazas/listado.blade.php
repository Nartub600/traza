@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Trazas</li>
  </ol>

  <h1 class="flex justify-between">
    Trazas
    <div class="flex">
      @can('crear trazas')
      <div class="dropdown">
        <a
          href="{{ route('trazas.create') }}"
          class="uppercase btn btn-success"
          data-target="#"
          data-toggle="dropdown"
          role="button"
        >
          Nueva traza
        </a>
        <ul class="p-1 dropdown-menu left-auto right-0">
          <li class="text-right">
            <a href="{{ url('/trazas/crear/chas') }}" class="uppercase">
              Solicitud de Certificación de Homologación de Autopartes y/o Elementos de Seguridad
            </a>
          </li>
          <li class="text-right">
            <a href="{{ url('/trazas/crear/cape') }}" class="uppercase">
              Solicitud del Certificado de Autoparte Primer Equipo (CAPE) - Excepción CHAS
            </a>
          </li>
          <li class="text-right">
            <a href="{{ url('/trazas/crear/excepcion-chas') }}" class="uppercase mb-0">
              Solicitud de Excepción CHAS
            </a>
          </li>
        </ul>
      </div>
      @endcan
      @can('exportar trazas')
      <button type="button" class="btn btn-success uppercase mx-2" onclick="exportarTrazas()">
        Exportar Excel
      </button>
      @endcan
    </div>
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>TIPO</td>
        <td>NÚMERO</td>
        <td>CREADO</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($trazas as $traza)
      <tr>
        <td>{{ $traza->id }}</td>
        <td>{{ __('traza.' . $traza->type) }}</td>
        <td>{{ $traza->number }}</td>
        <td>{{ $traza->created_at }}</td>
        <td class="text-center">
          @can('ver trazas')
            <a href="{{ route('trazas.show', $traza->id) }}" class="btn m-0 p-0">
              <i class="fa fa-eye"></i>
            </a>
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

  function exportarTrazas () {
    Swal.fire({
      type: 'info',
      text: 'En construcción'
    })
  }
</script>
@endpush
