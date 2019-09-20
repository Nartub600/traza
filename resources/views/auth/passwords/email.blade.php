@extends('layouts.app')

@section('content')
<div class="mx-8 my-auto md:m-auto w-full md:max-w-lg">
  <div class="bg-gris-intermedio border border-white border-solid p-8">
    <div class="bg-white flex flex-col items-center border border-gris-claro border-solid">
      <a href="{{ route('home') }}" aria-label="Argentina.gob.ar Presidencia de la Nación">
        <img
          alt="Argentina.gob.ar"
          src="{{ asset('images/argentinagob.svg') }}"
          height="50"
          class="my-6"
        >
      </a>

      <hr class="m-0 w-full">

      <p class="text-3xl leading-none my-3">
        Recuperar contraseña
      </p>

      <hr class="m-0 w-full">

      @if (session('status'))
        <div class="alert alert-success mx-8 mt-8 mb-0" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="w-full">
        @csrf

        <div class="w-2/3 mx-auto mt-8 form-group item-form @error('email') has-error @enderror">
          <label for="email" class="mb-4">Email <sup>*</sup></label>

          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback block mt-4" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="w-2/3 mx-auto mt-8 form-group item-form text-center">
          <button type="submit" class="btn btn-block btn-primary uppercase">
            Enviar email
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
