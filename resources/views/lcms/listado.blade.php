@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">LCMs</li>
  </ol>

  <h1 class="flex justify-between">
    Administrador de LCMs
    @can('crear lcms')
    <a href="{{ route('lcms.create') }}" class="uppercase btn btn-success">
      Nueva LCM
    </a>
    @endcan
  </h1>

  <hr class="my-4">

  <table class="table" id="tabla">
    <thead>
      <tr>
        <td>ID</td>
        <td>NÚMERO GDE</td>
        <td>NÚMERO ESPECIAL</td>
        <td>CREADO</td>
        <td>USUARIO</td>
        <td>REFERENCIA</td>
        <td>TIPO DOCUMENTO</td>
        <th class="text-center"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($lcms as $lcm)
      <tr>
        <td>{{ $lcm->id }}</td>
        <td>{{ $lcm->gde }}</td>
        <td>{{ $lcm->special }}</td>
        <td>{{ $lcm->created_at }}</td>
        <td>{{ $lcm->user->username }}</td>
        <td>{{ $lcm->reference }}</td>
        <td>{{ $lcm->type }}</td>
        <td class="text-center">
          @can('ver lcms')
          <a href="{{ route('lcms.show', $lcm->id) }}" class="btn m-0 p-0">
            <i class="fa fa-eye"></i>
          </a>
          @endcan
          @can('editar lcms')
          <a href="{{ route('lcms.edit', $lcm->id) }}" class="btn m-0 p-0">
            <i class="fa fa-edit"></i>
          </a>
          @endcan
          @can('eliminar lcms')
            <a
              class="btn m-0 p-0"
              href="{{ route('lcms.destroy', $lcm->id) }}"
              onclick="confirmDelete(event, {{ $lcm }})"
            >
                <i class="fa fa-times"></i>
            </a>
            <form id="delete-form-{{ $lcm->id }}" action="{{ route('lcms.destroy', $lcm->id) }}" method="POST" style="display: none;">
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

  function confirmDelete(event, lcm)
  {
    event.preventDefault()
    Swal.fire({
      title: 'Confirmar eliminación',
      html: `Desea eliminar <em>${lcm.gde}</em>?`,
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      reverseButtons: true,
      confirmButtonColor: '#0072BB'
    }).then(result => {
      if (result.value) {
        document.getElementById(`delete-form-${lcm.id}`).submit()
      }
    })
  }
</script>
@endpush
