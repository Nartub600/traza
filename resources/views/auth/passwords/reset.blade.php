@extends('layouts.app')

@section('content')
<div class="mx-8 my-auto md:m-auto w-full md:max-w-lg">
  <div class="bg-gris-intermedio border border-white border-solid p-8">
    <div class="bg-white flex flex-col items-center border border-gris-claro border-solid">
      <img
        alt="Argentina.gob.ar"
        src="{{ asset('images/argentinagob.svg') }}"
        height="50"
        class="my-6"
      >

      <hr class="m-0 w-full">

      <p class="text-3xl leading-none my-3">
        Reestablecer contraseña
      </p>

      <hr class="m-0 w-full">

      <form method="POST" action="{{ route('password.update') }}" class="w-full">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">

          <div class="w-2/3 mx-auto mt-8 form-group item-form @error('email') has-error @enderror">
            <label for="email" class="mb-4">Email <sup>*</sup></label>
            <input type="text" name="email" class="form-control" value="{{ $email ?? old('email') }}" required aria-required @error('email') is-invalid @enderror" autocomplete="email" autofocus>
            @error('email')
            <p class="help-block error hidden">Ingresá tu email</p>
            @enderror
          </div>

          <div class="w-2/3 mx-auto form-group item-form @error('password') has-error @enderror">
            <label for="password" class="mb-4">Contraseña <sup>*</sup></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <p class="help-block error hidden">Ingresá tu contraseña</p>
            @enderror
          </div>

          <div class="w-2/3 mx-auto form-group item-form @error('password') has-error @enderror">
            <label for="password-confirm" class="mb-4">Confirmar contraseña <sup>*</sup></label>
            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="w-2/3 mx-auto mt-8 form-group item-form text-center">
            <button type="submit" class="btn btn-block btn-primary uppercase">
                Reestablecer contraseña
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
