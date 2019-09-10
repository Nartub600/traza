@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li class="active">Perfil</li>
  </ol>

  <h1>
    Perfil
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('perfil.update', $user->id) }}" method="post">
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
          <label for="name" class="mb-4">Nombre Completo <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required value="{{ $user->name }}">
          <p class="help-block error hidden">Ingrese el nombre completo</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="username" class="mb-4">Nombre de usuario <sup>*</sup></label>
          <input type="text" name="username" class="form-control" required aria-required value="{{ $user->username }}">
          <p class="help-block error hidden">Ingrese el nombre de usuario</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="email" class="mb-4">Correo Electrónico <sup>*</sup></label>
          <input type="text" name="email" class="form-control" required aria-required value="{{ $user->email }}">
          <p class="help-block error hidden">Ingrese el correo electrónico</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Perfiles</label>
          <input readonly type="text" class="form-control" value="{{ $user->roles->map->name->implode(', ') }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Grupos de usuarios</label>
          <input readonly type="text" class="form-control" value="{{ $user->groups->map->name->implode(', ') }}">
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
