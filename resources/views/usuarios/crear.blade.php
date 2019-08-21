@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nuevo Usuario
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('usuarios.store') }}" method="post">
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
          <label for="name" class="mb-4">Nombre Completo <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required value="{{ old('name') }}">
          <p class="help-block error hidden">Ingrese el nombre completo</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="username" class="mb-4">Nombre de usuario <sup>*</sup></label>
          <input type="text" name="username" class="form-control" required aria-required value="{{ old('username') }}">
          <p class="help-block error hidden">Ingrese el nombre de usuario</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="email" class="mb-4">Correo Electrónico <sup>*</sup></label>
          <input type="text" name="email" class="form-control" required aria-required value="{{ old('email') }}">
          <p class="help-block error hidden">Ingrese el correo electrónico</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Estado <sup>*</sup></label>
          <select name="active" class="form-control" value="{{ old('active') }}">
            <option value="">---</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="password" class="mb-4">Contraseña <sup>*</sup></label>
          <input type="password" name="password" class="form-control" required aria-required>
          <p class="help-block error hidden">Ingrese la contraseña</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="password_confirmation" class="mb-4">Confirmar contraseña <sup>*</sup></label>
          <input type="password" name="password_confirmation" class="form-control" required aria-required>
          <p class="help-block error hidden">Confirme la contraseña</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Perfil (Permite seleccionar varios)</label>
          <select multiple name="roles[]" class="form-control">
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
          <p class="help-block error hidden">Seleccione al menos un perfil</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Grupo de usuarios (Permite seleccionar varios)</label>
          <select multiple name="groups[]" class="form-control">
            @foreach ($groups as $group)
            <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
          </select>
          <p class="help-block error hidden">Seleccione al menos un grupo</p>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('usuarios.index') }}">
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
