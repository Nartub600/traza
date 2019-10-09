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

      <div class="flex flex-wrap -mx-2">
        <div class="w-1/2 form-group item-form px-2 @error('name') has-error @enderror">
          <label for="name" class="mb-4">Nombre <sup>*</sup></label>
          <input type="text" name="name" class="form-control" required aria-required value="{{ old('name', $product->name) }}">
          @error('name')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="parent" class="mb-4">Padre <sup>*</sup></label>
          <select name="parent_id" class="form-control" id="select-parent">
            <option data-placeholder="true"></option>
            @foreach($products as $p)
              @include('productos.option', [ 'p' => $p, 'product' => $product ])
            @endforeach
          </select>
        </div>

        <div class="w-1/2 form-group item-form px-2 relative">
          <label for="active" class="mb-4">Estado <sup>*</sup></label>
          <select required name="active" class="form-control" id="select-active">
            <option data-placeholder="true"></option>
            <option value="1" @if (old('active', $product->active) === true) selected @endif>Activo</option>
            <option value="0" @if (old('active', $product->active) === false) selected @endif>Inactivo</option>
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
