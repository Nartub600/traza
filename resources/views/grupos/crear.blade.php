@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('grupos.index') }}">Grupos de Usuarios</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nuevo Grupo de Usuarios
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('grupos.store') }}" method="post">
      @csrf

      @if ($errors->any())
      <div class="alert alert-danger mx-3 mt-8">
        <h5>Se han producido los siguientes errores:</h5>
        <ol>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ol>
      </div>
      @endif

      <div class="flex flex-wrap -mx-4">
        <div class="w-1/2 form-group item-form px-4 @error('name') has-error @enderror">
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required>
          @error('name')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative @error('active') has-error @enderror">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <select required name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
          @error('active')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative">
          <label for="users[]" class="mb-4">Usuarios (Permite seleccionar varios)</label>
          <select multiple name="users[]" class="form-control" id="select-users">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('grupos.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase mb-0" type="submit">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
new SlimSelect({
  select: '#select-active',
  placeholder: 'Seleccione el estado',
  showSearch: false,
})

new SlimSelect({
  select: '#select-users',
  placeholder: 'Seleccione los usuarios',
  searchPlaceholder: 'Buscar',
})
</script>
@endpush
