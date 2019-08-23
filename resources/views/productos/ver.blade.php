@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('productos.index') }}">Productos</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver Producto <em>{{ $product->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
      <div class="flex flex-wrap -mx-4">
        <div class="w-1/2 form-group item-form px-4">
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" readonly value="{{ $product->name }}">
          <p class="help-block error hidden">Ingrese el nombre</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="family" class="mb-4">Familia <sup>*</sup></label>
          <input type="text" name="family" class="form-control" readonly value="{{ $product->family }}">
          <p class="help-block error hidden">Ingrese la familia</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <input readonly type="text" class="form-control" value="{{ $product->active ? 'Activo' : 'Inactivo' }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="picture" class="mb-4">Foto <sup>*</sup></label>
          @if ($product->picture)
          <img class="block w-64 mb-4" src="{{ $product->picture }}">
          @else
          <p class="italic">Actualmente sin foto</p>
          @endif
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('productos.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase" type="submit" :disabled="uploading">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
