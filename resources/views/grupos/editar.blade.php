@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('grupos.index') }}">Grupos de Usuarios</a></li>
    <li class="active">Editar</li>
  </ol>

  <h1>
    Editar grupo <em>{{ $group->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('grupos.update', $group->id) }}" method="post">
      @method('put')
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
        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required value="{{ old('name', $group->name) }}">
          <p class="help-block error hidden">Ingrese el nombre</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Estado <sup>*</sup></label>
          <select name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1" @if (old('active', $group->active) === true) selected @endif>Activo</option>
            <option value="0" @if (old('active', $group->active) === false) selected @endif>Inactivo</option>
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Usuarios (Permite seleccionar varios)</label>
          <select multiple name="users[]" class="form-control" id="select-users">
            @foreach ($users as $user)
            <option value="{{ $user->id }}" @if (old('users', $group->users)->contains($user)) selected @endif>{{ $user->username }}</option>
            @endforeach
          </select>
          {{-- <p class="help-block error hidden">Seleccione al menos un perfil</p> --}}
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('grupos.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase" type="submit">
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
