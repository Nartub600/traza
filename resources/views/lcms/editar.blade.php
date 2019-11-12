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
        <div class="w-1/2 form-group item-form px-4 relative @error('type') has-error @enderror">
          <label for="type" class="mb-4">Tipo de Licencia <sup>*</sup></label>
          <select required aria-required name="type" class="form-control" id="select-type">
            <option data-placeholder="true"></option>
            <option @if (old('type', $lcm->type)) selected @endif>Nueva</option>
            <option @if (old('type', $lcm->type)) selected @endif>Actualización Administrativa</option>
            <option @if (old('type', $lcm->type)) selected @endif>Actualización Técnica</option>
            <option @if (old('type', $lcm->type)) selected @endif>Extensión</option>
            <option @if (old('type', $lcm->type)) selected @endif>Renovación</option>
          </select>
          @error('type')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('defeats') has-error @enderror">
          <label for="defeats" class="mb-4">Anula y Reemplaza (Nº LCM)</label>
          <input type="text" name="defeats" class="form-control" value="{{ old('defeats', $lcm->defeats) }}">
          @error('defeats')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('number') has-error @enderror">
          <label for="number" class="mb-4">Nº LCM <sup>*</sup></label>
          <input type="text" name="number" class="form-control" required aria-required value="{{ old('number', $lcm->number) }}">
          @error('number')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('issued_at') has-error @enderror">
          <label for="issued_at" class="mb-4">Fecha de emisión</label>
          <input type="date" name="issued_at" class="form-control" value="{{ old('issued_at', $lcm->issued_at) }}">
          @error('issued_at')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('business_name') has-error @enderror">
          <label for="business_name" class="mb-4">Razón Social <sup>*</sup></label>
          <input type="text" name="business_name" class="form-control" required aria-required value="{{ old('business_name', $lcm->business_name) }}">
          @error('business_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('address') has-error @enderror">
          <label for="address" class="mb-4">Domicilio <sup>*</sup></label>
          <input type="text" name="address" class="form-control" required aria-required value="{{ old('address', $lcm->address) }}">
          @error('address')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('cuit') has-error @enderror">
          <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
          <input type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit', $lcm->cuit) }}">
          @error('cuit')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative @error('origin') has-error @enderror">
          <label for="origin" class="mb-4">País de Origen <sup>*</sup></label>
          <input type="text" name="origin" class="form-control" required aria-required value="{{ old('origin', $lcm->origin) }}">
          <select class="form-control" name="origin" required aria-required id="select-origin">
            <option data-placeholder="true"></option>
            @foreach ($countries as $country)
            <option @if (old('origin', $lcm->origin) === $country) selected @endif>{{ $country }}</option>
            @endforeach
          </select>
          @error('origin')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('manufacturing_place') has-error @enderror">
          <label for="manufacturing_place" class="mb-4">Lugar de Fabricación</label>
          <input type="text" name="manufacturing_place" class="form-control" value="{{ old('manufacturing_place', $lcm->manufacturing_place) }}">
          @error('manufacturing_place')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('commercial_name') has-error @enderror">
          <label for="commercial_name" class="mb-4">Denominación Comercial <sup>*</sup></label>
          <input type="text" name="commercial_name" class="form-control" required aria-required value="{{ old('commercial_name', $lcm->commercial_name) }}">
          @error('commercial_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('brand') has-error @enderror">
          <label for="brand" class="mb-4">Marca <sup>*</sup></label>
          <input type="text" name="brand" class="form-control" required aria-required value="{{ old('brand', $lcm->brand) }}">
          @error('brand')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('model') has-error @enderror">
          <label for="model" class="mb-4">Modelo <sup>*</sup></label>
          <input type="text" name="model" class="form-control" required aria-required value="{{ old('model', $lcm->model) }}">
          @error('model')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('category') has-error @enderror">
          <label for="category" class="mb-4">Categoría <sup>*</sup></label>
          <input type="text" name="category" class="form-control" required aria-required value="{{ old('category', $lcm->category) }}">
          @error('category')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>


        <div class="w-1/2 form-group item-form px-4 @error('version') has-error @enderror">
          <label for="version" class="mb-4">Versión (Nro. VIN) <sup>*</sup></label>
          <input type="text" name="version" class="form-control" required aria-required value="{{ old('version', $lcm->version) }}">
          @error('version')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('lcms.index') }}">
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
  IMask(document.querySelector('[name="cuit"]'), {
    mask: '00{-}000000[00]{-}0',
    lazy: false,
    placeholderChar: '#'
  })

  new SlimSelect({
    select: '#select-type',
    placeholder: 'Seleccione el tipo',
    searchPlaceholder: 'Buscar',
  })

  new SlimSelect({
    select: '#select-origin',
    placeholder: 'Seleccione el origen',
    searchPlaceholder: 'Buscar',
  })
</script>
@endpush
