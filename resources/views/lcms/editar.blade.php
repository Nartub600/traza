@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('lcms.index') }}">LCMs</a></li>
    <li class="active">Editar</li>
  </ol>

  <h1>
    Editar LCM <em>{{ $lcm->gde }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('lcms.update', $lcm->id) }}" method="post">
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
          <label for="gde" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="gde" class="form-control" required aria-required value="{{ old('gde', $lcm->gde) }}">
          <p class="help-block error hidden">Ingrese el número GDE</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="special" class="mb-4">Número Especial <sup>*</sup></label>
          <input type="text" name="special" class="form-control" required aria-required value="{{ old('special', $lcm->special) }}">
          <p class="help-block error hidden">Ingrese el número especial</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="reference" class="mb-4">Referencia <sup>*</sup></label>
          <input type="text" name="reference" class="form-control" required aria-required value="{{ old('reference', $lcm->reference) }}">
          <p class="help-block error hidden">Ingrese la referencia</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="type" class="mb-4">Tipo Documento <sup>*</sup></label>
          <input type="text" name="type" class="form-control" required aria-required value="{{ old('type', $lcm->type) }}">
          <p class="help-block error hidden">Ingrese el tipo de documento</p>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('lcms.index') }}">
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
