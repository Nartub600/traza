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

      <div class="flex flex-wrap -mx-2">
        <div class="w-1/2 form-group item-form px-2 @error('name') has-error @enderror">
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required>
          @error('name')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="parent" class="mb-4">Padre</label>
          <select name="parent_id" class="form-control" id="select-parent">
            <option data-placeholder="true"></option>
            @foreach($products as $p)
              @include('productos.option', [ 'p' => $p ])
            @endforeach
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-2 relative @error('name') has-error @enderror">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <select required name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
          @error('name')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('productos.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase mb-0" type="submit">
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
  select: '#select-parent',
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
