@extends('layouts.default')

@section('content')
<traza-form
  inline-template
  :traza="{{ $traza }}"
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('trazas.index') }}">Trazas</a></li>
      <li class="active">Ver</li>
    </ol>

    <h1 class="flex justify-between">
      <span>
        Ver traza <em>{{ $traza->number }}</em>
      </span>

      @if ($traza->type === 'chas' && !$traza->approved)
      <div class="dropdown">
        <button
          class="uppercase btn btn-success"
          data-target="#"
          data-toggle="dropdown"
          role="button"
        >
          Aprobar licencias
        </button>
        <ul class="p-1 dropdown-menu left-auto right-0">
          <li>
            <label class="text-base">
              Seleccionar archivo
            </label>
            <importer
              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
              endpoint="{{ route('import.aprobar-chas-extranjera') }}"
              @valid="data => (aprobar = data, excel = true, showApprovalConfirmation())"
            >
            </importer>
            {{-- <form
              action="{{ route('trazas.aprobar', $traza->id) }}"
              v-if="excel && aprobar.length > 0"
              class="text-center"
            >
              <formalizer
                name="autopartes"
                :data="aprobar"
              >
              </formalizer>
              <button class="btn btn-primary mt-2">
                Confirmar
              </button>
            </form> --}}
          </li>
        </ul>
      </div>
      @endif
    </h1>

    <hr class="my-4">

    <div class="bg-white p-4 mb-4">
      <div class="flex flex-wrap -mx-4">
        <div class="w-1/2 form-group item-form px-4 @error('number') has-error @enderror">
            <label for="number" class="mb-4">Número de TAD <sup>*</sup></label>
            <input readonly value="{{ $traza->number }}" type="text" class="form-control">
            @error('number')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('user') has-error @enderror">
            <label for="user" class="mb-4">Usuario iniciador <sup>*</sup></label>
            <input readonly value="{{ $traza->user }}" type="text" class="form-control">
            @error('user')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('division') has-error @enderror">
            <label for="division" class="mb-4">Repartición iniciadora <sup>*</sup></label>
            <input readonly value="{{ $traza->division }}" type="text" class="form-control">
            @error('division')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('sector') has-error @enderror">
            <label for="sector" class="mb-4">Sector iniciador <sup>*</sup></label>
            <input readonly value="{{ $traza->sector }}" type="text" class="form-control">
            @error('sector')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('tag') has-error @enderror">
            <label for="tag" class="mb-4">Etiqueta <sup>*</sup></label>
            <input readonly value="{{ $traza->tag }}" type="text" class="form-control">
            @error('tag')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('validation') has-error @enderror">
            <label for="validation" class="mb-4">Validación inicial <sup>*</sup></label>
            <input readonly value="{{ $traza->validation }}" type="text" class="form-control">
            @error('validation')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 relative @error('signature') has-error @enderror">
            <label for="signature" class="mb-4">Firma conjunta <sup>*</sup></label>
            <input readonly value="{{ $traza->signature ? 'Si' : 'No' }}" type="text" class="form-control">
            @error('signature')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/2 form-group item-form px-4 @error('auth_level') has-error @enderror">
            <label for="auth_level" class="mb-4">Nivel de autenticación <sup>*</sup></label>
            <input readonly value="{{ $traza->auth_level }}" type="text" class="form-control">
            @error('auth_level')
              <p class="help-block error hidden">{{ $message }}</p>
            @enderror
          </div>
      </div>

      @switch($traza->type)
        @case('chas')
        @case('excepcion-chas')
          @if($traza->autoparts->isNotEmpty())
            <h3>
              Autopartes
            </h3>
            <div class="flex flex-wrap">
              @foreach ($traza->autoparts as $autopart)
              <div class="flex items-center justify-center w-1/2">
                <p>
                  {{ $autopart->brand }} {{ $autopart->model }} {{ $autopart->origin }} @if($autopart->chas)<span class="text-verde font-bold">{{ $autopart->chas }}</span>
                </p>
                <img src="data:image/png;base64,{{ base64_encode($autopart->qr) }}">@endif
              </div>
              @endforeach
            </div>
          @endif
        @break

        @case('cape')
          @if($traza->lcms->isNotEmpty())
            <h3>
              Autopartes
            </h3>
            <div class="flex flex-wrap">
              @foreach ($traza->lcms as $lcm)
              <div class="flex items-center justify-center w-1/2">
                <p>
                  {{ $lcm->brand }} {{$lcm->model}} {{$lcm->country}} @if($lcm->cape)<span class="text-verde font-bold">{{$lcm->cape}}</span>
                </p>
                <img src="data:image/png;base64,{{ base64_encode($lcm->qr) }}">@endif
              </div>
              @endforeach
            </div>
          @endif
        @break
      @endswitch

      <h3>
        Documentos
      </h3>

      <div class="flex flex-wrap -mx-4">
        @foreach($traza->files as $file)
          <div class="w-full px-4">
            <a href="{{ Storage::url($file['file']) }}" download="{{ $file['name'] }}">
              @lang('traza.' . $file['type'])
            </a>
          </div>
        @endforeach
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('trazas.index') }}">
          Volver
        </a>
      </div>
    </div>
  </div>
</traza-form>
@endsection
