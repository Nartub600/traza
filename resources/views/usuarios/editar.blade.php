@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="active">Editar</li>
  </ol>

  <h1>
    Editar usuario <em>{{ $user->username }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('usuarios.update', $user->id) }}" method="post">
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

      <div class="flex flex-wrap -mx-2">
        <div class="w-1/2 form-group item-form px-2">
          <label for="name" class="mb-4">Nombre Completo <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required value="{{ $user->name }}">
          <p class="help-block error hidden">Ingrese el nombre completo</p>
        </div>

        <div class="w-1/2 form-group item-form px-2">
          <label for="username" class="mb-4">Nombre de usuario <sup>*</sup></label>
          <input type="text" name="username" class="form-control" required aria-required value="{{ $user->username }}">
          <p class="help-block error hidden">Ingrese el nombre de usuario</p>
        </div>

        <div class="w-1/2 form-group item-form px-2">
          <label for="email" class="mb-4">Correo Electrónico <sup>*</sup></label>
          <input type="email" name="email" class="form-control" required aria-required value="{{ $user->email }}">
          <p class="help-block error hidden">Ingrese el correo electrónico</p>
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="name" class="mb-4">Estado <sup>*</sup></label>
          <select required name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1" @if ($user->active === true) selected @endif>Activo</option>
            <option value="0" @if ($user->active === false) selected @endif>Inactivo</option>
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-2">
          <label for="password" class="mb-4">Contraseña <sup>*</sup></label>
          <input type="password" name="password" class="form-control">
          <p class="help-block error hidden">Ingrese la contraseña</p>
        </div>

        <div class="w-1/2 form-group item-form px-2">
          <label for="password_confirmation" class="mb-4">Confirmar contraseña <sup>*</sup></label>
          <input type="password" name="password_confirmation" class="form-control">
          <p class="help-block error hidden">Confirme la contraseña</p>
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="name" class="mb-4">Perfil (Permite seleccionar varios)</label>
          <select required multiple name="roles[]" class="form-control" id="select-roles">
            @foreach ($roles as $role)
            <option class="capitalize" value="{{ $role->id }}" @if ($user->roles->contains($role)) selected @endif>{{ $role->name }}</option>
            @endforeach
          </select>
          <p class="help-block error hidden">Seleccione al menos un perfil</p>
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="name" class="mb-4">Grupo de usuarios (Permite seleccionar varios)</label>
          <select required multiple name="groups[]" class="form-control" id="select-groups">
            @foreach ($groups as $group)
            <option value="{{ $group->id }}" @if ($user->groups->contains($group)) selected @endif>{{ $group->name }}</option>
            @endforeach
          </select>
          <p class="help-block error hidden">Seleccione al menos un grupo</p>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('usuarios.index') }}">
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
  select: '#select-roles',
  placeholder: 'Seleccione los perfiles',
  searchPlaceholder: 'Buscar',
})

new SlimSelect({
  select: '#select-groups',
  placeholder: 'Seleccione los grupos',
  searchPlaceholder: 'Buscar',
})

new SlimSelect({
  select: '#select-active',
  placeholder: 'Seleccione el estado',
  showSearch: false,
})
</script>
@endpush
