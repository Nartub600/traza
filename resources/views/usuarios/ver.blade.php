@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver usuario <em>{{ $user->username }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Nombre Completo <sup>*</sup></label>
        <input readonly type="text" class="form-control" value="{{ $user->name }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Nombre de usuario <sup>*</sup></label>
        <input readonly type="text" class="form-control" value="{{ $user->username }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Correo Electrónico <sup>*</sup></label>
        <input readonly type="text" class="form-control" value="{{ $user->email }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Perfiles </label>
        <input readonly type="text" class="form-control" value="{{ $user->roles->map->name->implode(', ') }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Estado <sup>*</sup></label>
        <input readonly type="text" class="form-control" value="{{ $user->active ? 'Activo' : 'Inactivo' }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Grupos de usuarios</label>
        <input readonly type="text" class="form-control" value="{{ $user->groups->map->name->implode(', ') }}">
      </div>
    </div>

    <div class="flex justify-end">
      <a class="btn btn-success uppercase" href="{{ route('usuarios.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection
