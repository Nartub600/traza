@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('ncm.index') }}">NCM</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nueva categoría de NCM
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('ncm.store') }}" method="post">
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
        <div class="w-1/2 form-group item-form px-4 @error('category') has-error @enderror">
          <label for="category" class="mb-4">Categoría <sup>*</sup></label>
          <input type="text" name="category" class="form-control" required aria-required>
          @error('category')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('description') has-error @enderror">
          <label for="description" class="mb-4">Descripción <sup>*</sup></label>
          <input type="text" name="description" class="form-control" required aria-required>
          @error('description')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative">
          <label for="name" class="mb-4">Estado <sup>*</sup></label>
          <select required name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('ncm.index') }}">
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
