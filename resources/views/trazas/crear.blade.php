@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('trazas.index') }}">Trazas</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nueva Traza
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('trazas.store') }}" method="post">
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
          <label for="number" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="number" class="form-control" required aria-required>
          <p class="help-block error hidden">Ingrese el nombre</p>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('trazas.index') }}">
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
