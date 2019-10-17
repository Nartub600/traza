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
    <form action="{{ route('trazas.store') }}" method="post">
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
        {{-- <div class="w-1/2 form-group item-form px-4">
          <label class="mb-4">Nombre del trámite <sup>*</sup></label>
          <input readonly type="text" class="form-control" value="Solicitud del Certificación de Homologación de Autopartes y/o elementos de Seguridad">
        </div> --}}

        <div class="w-1/2 form-group item-form px-4 @error('tad') has-error @enderror">
          <label for="tad" class="mb-4">Número de TAD <sup>*</sup></label>
          <input value="{{ old('tad') }}" type="text" name="tad" class="form-control" required aria-required>
          @error('tad')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('user') has-error @enderror">
          <label for="user" class="mb-4">Usuario iniciador <sup>*</sup></label>
          <input value="{{ old('user') }}" type="text" name="user" class="form-control" required aria-required>
          @error('user')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('division') has-error @enderror">
          <label for="division" class="mb-4">Repartición iniciadora <sup>*</sup></label>
          <input value="{{ old('division') }}" type="text" name="division" class="form-control" required aria-required>
          @error('division')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('sector') has-error @enderror">
          <label for="sector" class="mb-4">Sector iniciador <sup>*</sup></label>
          <input value="{{ old('sector') }}" type="text" name="sector" class="form-control" required aria-required>
          @error('sector')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('tag') has-error @enderror">
          <label for="tag" class="mb-4">Etiqueta <sup>*</sup></label>
          <input value="{{ old('tag') }}" type="text" name="tag" class="form-control" required aria-required>
          @error('tag')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('validation') has-error @enderror">
          <label for="validation" class="mb-4">Validación inicial <sup>*</sup></label>
          <input value="{{ old('validation') }}" type="text" name="validation" class="form-control" required aria-required>
          @error('validation')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('signature') has-error @enderror">
          <label for="signature" class="mb-4">Firma conjunta <sup>*</sup></label>
          <input value="{{ old('signature') }}" type="text" name="signature" class="form-control" required aria-required>
          @error('signature')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('auth_level') has-error @enderror">
          <label for="auth_level" class="mb-4">Nivel de autenticación <sup>*</sup></label>
          <input value="{{ old('auth_level') }}" type="text" name="auth_level" class="form-control" required aria-required>
          @error('auth_level')
            <p class="help-block error hidden">{{ $message }}</p>
          @enderror
        </div>

        @switch ($type)
          @case ('chas')
            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Anexo | Declaración Jurada <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Solicitud de Homologación de Autopartes y/o elementos de Seguridad <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Certificado de homologación extranjera WP29 (Obligatorio si es Importador) <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Certificado de autopartes (Certificadora nacional) <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Foto(s) de la(s) autoparte(s) y de/los envase(s) <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="number" class="mb-4">Catálogo correspondiente <sup>*</sup></label>
              <input type="file" name="number" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>
          @break

          @case ('cape')
            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Solicitud de CAPE <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Descripción de los bienes (formato Excel versión) <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Folletería piezas autopartes <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>
          @break

          @case ('excepcion-chas')
            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Solicitud de Excepción de CHAS <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Descripción de los bienes (formato Excel) <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Folletería piezas autopartes <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 form-group item-form px-4 @error('') has-error @enderror">
              <label for="" class="mb-4">Folletería Maquinaria <sup>*</sup></label>
              <input type="file" name="" class="form-control" required aria-required>
              @error('')
                <p class="help-block error hidden">{{ $message }}</p>
              @enderror
            </div>
          @break
        @endswitch
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('trazas.index') }}">
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
