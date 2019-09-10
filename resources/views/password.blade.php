@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Cambiar contraseña</li>
  </ol>

  <h1>
    Cambiar contraseña
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('password.update', $user->id) }}" method="post">
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
          <label for="old_password" class="mb-4">Contraseña actual<sup>*</sup></label>
          <input required type="password" name="old_password" class="form-control">
          <p class="help-block error hidden">Ingrese la contraseña actual</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="password" class="mb-4">Nueva contraseña<sup>*</sup></label>
          <input required type="password" name="password" class="form-control">
          <p class="help-block error hidden">Ingrese la nueva contraseña</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="password_confirmation" class="mb-4">Confirmar contraseña <sup>*</sup></label>
          <input required type="password" name="password_confirmation" class="form-control">
          <p class="help-block error hidden">Confirme la nueva contraseña</p>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('home') }}">
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
