@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('lcms.index') }}">LCMs</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver LCMS <em>{{ $lcm->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-1/2 form-group item-form px-4">
        <label for="gde" class="mb-4">Nombre <sup>*</sup></label>
        <input readonly type="text" name="gde" class="form-control" required aria-required value="{{ $lcm->gde }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="special" class="mb-4">Número Especial <sup>*</sup></label>
        <input readonly type="text" name="special" class="form-control" required aria-required value="{{ $lcm->special }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="reference" class="mb-4">Referencia <sup>*</sup></label>
        <input readonly type="text" name="reference" class="form-control" required aria-required value="{{ $lcm->reference }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="type" class="mb-4">Tipo Documento <sup>*</sup></label>
        <input readonly type="text" name="type" class="form-control" required aria-required value="{{ $lcm->type }}">
      </div>
    </div>

    <div class="flex justify-end">
      <a class="btn btn-success uppercase mr-4" href="{{ route('lcms.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection
