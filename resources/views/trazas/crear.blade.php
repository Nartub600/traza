@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('trazas.index') }}">Trazas</a></li>
    <li class="active">Nueva</li>
  </ol>

  <h1>
    @switch ($type)
      @case ('chas')
        Nueva Solicitud de Certificación de Homologación de Autopartes y/o elementos de Seguridad
      @break

      @case ('cape')
        Solicitud del Certificado de Autoparte Primer Equipo (C.A.P.E) - Excepción CHAS
      @break

      @case ('excepcion-chas')
        Solicitud de Excepción de Chas
      @break
    @endswitch
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('trazas.store') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="type" value="{{ $type }}">
      @csrf

      @if ($errors->any())
      <div class="alert alert-danger mx-3 mt-8">
        <h5 class="text-center">Se han producido errores</h5>
        <ol>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ol>
      </div>
      @endif

      <div class="flex flex-wrap -mx-2">
        {{-- <div class="w-1/2 form-group item-form px-2">
          <label class="mb-4">Nombre del trámite <sup>*</sup></label>
          <input readonly type="text" class="form-control" value="Solicitud del Certificación de Homologación de Autopartes y/o elementos de Seguridad">
        </div> --}}

        <div class="w-1/2 form-group item-form px-2 @error('number') has-error @enderror">
          <label for="number" class="mb-4">Número de TAD <sup>*</sup></label>
          <input value="{{ old('number') }}" type="text" name="number" class="form-control">
          @error('number')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('user') has-error @enderror">
          <label for="user" class="mb-4">Usuario iniciador <sup>*</sup></label>
          <input value="{{ old('user') }}" type="text" name="user" class="form-control">
          @error('user')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('division') has-error @enderror">
          <label for="division" class="mb-4">Repartición iniciadora <sup>*</sup></label>
          <input value="{{ old('division') }}" type="text" name="division" class="form-control">
          @error('division')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('sector') has-error @enderror">
          <label for="sector" class="mb-4">Sector iniciador <sup>*</sup></label>
          <input value="{{ old('sector') }}" type="text" name="sector" class="form-control">
          @error('sector')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('tag') has-error @enderror">
          <label for="tag" class="mb-4">Etiqueta <sup>*</sup></label>
          <input value="{{ old('tag') }}" type="text" name="tag" class="form-control">
          @error('tag')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('validation') has-error @enderror">
          <label for="validation" class="mb-4">Validación inicial <sup>*</sup></label>
          <input value="{{ old('validation') }}" type="text" name="validation" class="form-control">
          @error('validation')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 relative @error('signature') has-error @enderror">
          <label for="signature" class="mb-4">Firma conjunta <sup>*</sup></label>
          <select name="signature" class="form-control" id="select-signature">
            <option data-placeholder="true"></option>
            <option @if (old('active') === true) selected @endif value="1">Si</option>
            <option @if (old('active') === false) selected @endif value="0">No</option>
          </select>
          @error('signature')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-2 @error('auth_level') has-error @enderror">
          <label for="auth_level" class="mb-4">Nivel de autenticación <sup>*</sup></label>
          <input value="{{ old('auth_level') }}" type="text" name="auth_level" class="form-control">
          @error('auth_level')
            <p class="help-block error">{{ $message }}</p>
          @enderror
        </div>

        @switch($type)
          @case('chas')
            <div class="w-1/2 form-group item-form px-2 @error('documents.declaracion_jurada') has-error @enderror">
              <label for="documents[declaracion_jurada]" class="mb-4">Anexo | Declaración Jurada <sup>*</sup></label>
              <input type="file" name="documents[declaracion_jurada]" class="form-control">
              @error('documents.declaracion_jurada')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.solicitud_autopartes') has-error @enderror">
              <label for="documents[solicitud_autopartes]" class="mb-4">Solicitud de Homologación de Autopartes y/o elementos de Seguridad <sup>*</sup></label>
              <input type="file" name="documents[solicitud_autopartes]" class="form-control">
              @error('documents.solicitud_autopartes')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.wp29') has-error @enderror">
              <label for="documents[wp29]" class="mb-4">Certificado de homologación extranjera WP29 (Obligatorio si es Importador) <sup>*</sup></label>
              <input multiple type="file" name="documents[wp29][]" class="form-control">
              @error('documents.wp29')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.certificado') has-error @enderror">
              <label for="documents[certificado]" class="mb-4">Certificado de autopartes (Certificadora nacional) <sup>*</sup></label>
              <input multiple type="file" name="documents[certificado][]" class="form-control">
              @error('documents.certificado')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.foto') has-error @enderror">
              <label for="documents[foto]" class="mb-4">Foto(s) de la(s) autoparte(s) y de/los envase(s) <sup>*</sup></label>
              <input multiple type="file" name="documents[foto][]" class="form-control">
              @error('documents.foto')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.catalogo') has-error @enderror">
              <label for="documents[catalogo]" class="mb-4">Catálogo correspondiente <sup>*</sup></label>
              <input type="file" name="documents[catalogo]" class="form-control">
              @error('documents.catalogo')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>
          @break

          @case('cape')
            <div class="w-1/2 form-group item-form px-2 @error('documents.solicitud_cape') has-error @enderror">
              <label for="documents[solicitud_cape]" class="mb-4">Solicitud de CAPE <sup>*</sup></label>
              <input type="file" name="documents[solicitud_cape]" class="form-control">
              @error('documents.solicitud_cape')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.autopartes') has-error @enderror">
              <label for="documents[autopartes]" class="mb-4">Descripción de los bienes <sup>*</sup> (<a href="{{ asset('plantillas/cape.xlsx') }}">descargar plantilla</a>)</label>
              {{-- <input type="file" name="documents[autopartes]" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"> --}}
              <importer
                name="documents[autopartes]"
                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                endpoint="{{ route('import.cape') }}"
                @valid="valid = true"
              >
              </importer>
              @error('documents.autopartes')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.foto') has-error @enderror">
              <label for="documents[foto]" class="mb-4">Folletería piezas autopartes <sup>*</sup></label>
              <input multiple type="file" name="documents[foto][]" class="form-control" accept="image/*">
              @error('documents.foto')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>
          @break

          @case('excepcion-chas')
            <div class="w-1/2 form-group item-form px-2 @error('documents.excepcion_chas') has-error @enderror">
              <label for="documents[excepcion_chas]" class="mb-4">Solicitud de Excepción de CHAS <sup>*</sup></label>
              <input type="file" name="documents[excepcion_chas]" class="form-control">
              @error('documents.excepcion_chas')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.descripcion_bienes') has-error @enderror">
              <label for="documents[descripcion_bienes]" class="mb-4">Descripción de los bienes (formato Excel) <sup>*</sup></label>
              <input type="file" name="documents[descripcion_bienes]" class="form-control">
              @error('documents.descripcion_bienes')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.folleto') has-error @enderror">
              <label for="documents[folleto_autopartes]" class="mb-4">Folletería piezas autopartes <sup>*</sup></label>
              <input type="file" name="documents[folleto]" class="form-control">
              @error('documents.folleto')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-2 @error('documents.folleto_maquinaria') has-error @enderror">
              <label for="documents[folleto_maquinaria]" class="mb-4">Folletería Maquinaria <sup>*</sup></label>
              <input type="file" name="documents[folleto_maquinaria]" class="form-control">
              @error('documents.folleto_maquinaria')
                <p class="help-block error">{{ $message }}</p>
              @enderror
            </div>
          @break
        @endswitch
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('trazas.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase mb-0" type="submit" v-show="valid">
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
  select: '#select-signature',
  placeholder: ' ',
  showSearch: false,
})
</script>
@endpush
