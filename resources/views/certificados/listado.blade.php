@extends('layouts.default')

@section('content')
<autopartes
  inline-template
  certificates-template="{{ asset('plantillas/licencias.xlsx') }}"
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li class="active">Licencias</li>
    </ol>

    <h1 class="flex justify-between">
      Licencias
      <div>
        {{-- <button type="button" class="btn btn-success uppercase mx-2" @click="beginCertificatesImport">
          Cargar Desde Excel
        </button>
        <input
          action="{{ route('import.certificates') }}"
          class="hidden"
          type="file"
          ref="excel"
          @input="handleCertificatesExcel"
          accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
        > --}}

        @can('crear licencias')
        <a href="{{ route('licencias.create') }}" class="uppercase btn btn-success">
          Nueva licencia
        </a>
        @endcan
      </div>
    </h1>

    <hr class="my-4">

    <table class="table" id="tabla">
      <thead>
        <tr>
          <td>ID</td>
          <td>NÚMERO LICENCIA</td>
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
            @can('ver licencias')
            <a href="{{ route('licencias.show', $certificate->id) }}" class="btn m-0 p-0">
              <i class="fa fa-eye"></i>
            </a>
            @endcan
            @can('editar licencias')
            <a href="{{ route('licencias.edit', $certificate->id) }}" class="btn m-0 p-0">
              <i class="fa fa-edit"></i>
            </a>
            @endcan
            @can('eliminar licencias')
              <a
                class="mx-2 my-0 p-0"
                href="{{ route('licencias.destroy', $certificate->id) }}"
                onclick="confirmDelete(event, {{ $certificate }})"
              >
                  <i class="fa fa-times"></i>
              </a>
              <form id="delete-form-{{ $certificate->id }}" action="{{ route('licencias.destroy', $certificate->id) }}" method="POST" style="display: none;">
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
</autopartes>
@endsection

@push('scripts')
<script>
  function confirmDelete(event, certificate)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${certificate.number}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${certificate.id}`).submit()
      }
    })
  }
</script>
@endpush
