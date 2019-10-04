@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('ncm.index') }}">NCM</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver categoría de NCM <em>{{ $ncm->description }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-1/2 form-group item-form px-4">
        <label for="category" class="mb-4">Categoría <sup>*</sup></label>
        <input readonly type="text" name="category" class="form-control" required aria-required value="{{ old('category', $ncm->category) }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="description" class="mb-4">Descripción <sup>*</sup></label>
        <input readonly type="text" name="description" class="form-control" required aria-required value="{{ old('description', $ncm->description) }}">
      </div>

      <div class="w-1/2 form-group item-form px-4 relative">
        <label for="active" class="mb-4">Estado <sup>*</sup></label>
        <select disabled required name="active" class="form-control" id="select-active">
          <option data-placeholder="true"></option>
          <option value="1" @if (old('active', $ncm->active) === true) selected @endif>Activo</option>
          <option value="0" @if (old('active', $ncm->active) === false) selected @endif>Inactivo</option>
        </select>
      </div>
    </div>

    <div class="flex justify-end">
      <a class="btn btn-success uppercase mr-4" href="{{ route('ncm.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
new SlimSelect({
  select: '#select-active',
  placeholder: 'Seleccione el estado',
  showSearch: false,
})

new SlimSelect({
  select: '#select-users',
  placeholder: 'Seleccione los usuarios',
  searchPlaceholder: 'Buscar',
})
</script>
@endpush
