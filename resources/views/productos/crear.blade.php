@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('productos.index') }}">Productos</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nuevo Producto
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('productos.store') }}" method="post">
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
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required>
          <p class="help-block error hidden">Ingrese el nombre</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="family" class="mb-4">Familia <sup>*</sup></label>
          <select name="family_id" class="form-control" id="select-family">
            <option data-placeholder="true"></option>
            @foreach ($products as $p)
            <option value="{{ $p->id }}" >{{ $p->name }}</option>
            @endforeach
          </select>
          <p class="help-block error hidden">Ingrese la familia</p>
        </div>

        <div class="w-1/2 form-group item-form px-4">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <select name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
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

@push('scripts')
<script>
new SlimSelect({
  select: '#select-family',
  placeholder: 'Seleccione la familia',
  searchPlaceholder: 'Buscar',
})

new SlimSelect({
  select: '#select-active',
  placeholder: 'Seleccione el estado',
  showSearch: false,
})
</script>
@endpush
