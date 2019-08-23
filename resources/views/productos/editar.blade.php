@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('productos.index') }}">Productos</a></li>
    <li class="active">Editar</li>
  </ol>

  <h1>
    Editar Producto <em>{{ $product->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('productos.update', $product->id) }}" method="post">
      @csrf
      @method('put')

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
          <input type="text" name="name" class="form-control" required aria-required value="{{ old('name', $product->name) }}">
          <p class="help-block error hidden">Ingrese el nombre</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="family" class="mb-4">Familia <sup>*</sup></label>
          <input type="text" name="family" class="form-control" required aria-required value="{{ old('family', $product->family) }}">
          <p class="help-block error hidden">Ingrese la familia</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <select name="active" class="form-control">
            <option value="">---</option>
            <option value="1" @if (old('active', $product->active) === true) selected @endif>Activo</option>
            <option value="0" @if (old('active', $product->active) === true) selected @endif>Inactivo</option>
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="picture" class="mb-4">Foto <sup>*</sup></label>
          @if ($product->picture)
          <p class="italic">Foto actual</p>
          <img class="block w-64 mb-4" src="{{ $product->picture }}">
          @else
          <p class="italic">Actualmente sin foto</p>
          @endif
          <file-pond
            name="picture"
            ref="pond"
            :accepted-file-types="['image/*']"
            label-file-type-not-allowed="Debe elegir una imagen"
            file-validate-type-label-expected-types="Archivos JPG, PNG"
            :label-idle="'Arrastre un archivo aquí o <span class=\'filepond--label-action\'>elija uno</span>'"
            label-file-processing="Subiendo"
            label-tap-to-cancel="click para cancelar"
            label-tap-to-undo="click para deshacer"
            label-file-processing-complete="Subida completa"
            server="/uploads"
            @addfile="() => uploading = true"
            @processfile="() => uploading = false"
          >
          </file-pond>
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
