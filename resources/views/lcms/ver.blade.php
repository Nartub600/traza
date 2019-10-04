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
          <label for="type" class="mb-4">Tipo de Licencia <sup>*</sup></label>
          <input readonly type="text" name="type" class="form-control" required aria-required value="{{ old('type', $lcm->type) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="defeats" class="mb-4">Anula y Reemplaza (Nº LCM) <sup>*</sup></label>
          <input readonly type="text" name="defeats" class="form-control" required aria-required value="{{ old('defeats', $lcm->defeats) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="number" class="mb-4">Nº LCM <sup>*</sup></label>
          <input readonly type="text" name="number" class="form-control" required aria-required value="{{ old('number', $lcm->number) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="issued_at" class="mb-4">Fecha de emisión <sup>*</sup></label>
          <input readonly type="text" name="issued_at" class="form-control" required aria-required value="{{ old('issued_at', $lcm->issued_at) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="business_name" class="mb-4">Razón Social <sup>*</sup></label>
          <input readonly type="text" name="business_name" class="form-control" required aria-required value="{{ old('business_name', $lcm->business_name) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="address" class="mb-4">Domicilio <sup>*</sup></label>
          <input readonly type="text" name="address" class="form-control" required aria-required value="{{ old('address', $lcm->address) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
          <input readonly type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit', $lcm->cuit) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="country" class="mb-4">País de Origen <sup>*</sup></label>
          <input readonly type="text" name="country" class="form-control" required aria-required value="{{ old('country', $lcm->country) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="manufacturing_place" class="mb-4">Lugar de Fabricación <sup>*</sup></label>
          <input readonly type="text" name="manufacturing_place" class="form-control" required aria-required value="{{ old('manufacturing_place', $lcm->manufacturing_place) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="commercial_name" class="mb-4">Denominación Comercial <sup>*</sup></label>
          <input readonly type="text" name="commercial_name" class="form-control" required aria-required value="{{ old('commercial_name', $lcm->commercial_name) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="brand" class="mb-4">Marca <sup>*</sup></label>
          <input readonly type="text" name="brand" class="form-control" required aria-required value="{{ old('brand', $lcm->brand) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="model" class="mb-4">Modelo <sup>*</sup></label>
          <input readonly type="text" name="model" class="form-control" required aria-required value="{{ old('model', $lcm->model) }}">
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="category" class="mb-4">Categoría <sup>*</sup></label>
          <input readonly type="text" name="category" class="form-control" required aria-required value="{{ old('category', $lcm->category) }}">
        </div>


        <div class="w-1/2 form-group item-form px-4">
          <label for="version" class="mb-4">Versión (Nro. VIN) <sup>*</sup></label>
          <input readonly type="text" name="version" class="form-control" required aria-required value="{{ old('version', $lcm->version) }}">
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
