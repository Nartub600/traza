@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('grupos.index') }}">Grupos de Usuarios</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver grupo <em>{{ $group->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Nombre Completo <sup>*</sup></label>
        <input type="text" name="name" class="form-control" readonly value="{{ $group->name }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Estado <sup>*</sup></label>
        <input readonly type="text" class="form-control" value="{{ $group->active ? 'Activo' : 'Inactivo' }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="name" class="mb-4">Usuarios (Permite seleccionar varios)</label>
        <input readonly type="text" class="form-control" value="{{ $group->users->map->username->implode(', ') }}">
      </div>
    </div>

    <div class="flex justify-end">
      <a class="btn btn-success uppercase mt-4 mb-0" href="{{ route('grupos.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection
