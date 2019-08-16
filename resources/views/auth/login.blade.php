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
        Inicia sesión
      </p>

      <hr class="m-0 w-full">

      <form method="post" action="{{ route('login') }}" class="w-full">
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

          <div class="w-2/3 mx-auto mt-8 form-group item-form @error('username') has-error @enderror">
            <label for="nombre" class="mb-4">Nombre de usuario <sup>*</sup></label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required aria-required>
            <p class="help-block error hidden">Ingresá tu nombre</p>
          </div>

          <div class="w-2/3 mx-auto form-group item-form @error('password') has-error @enderror"">
            <label for="password" class="mb-4">Contraseña <sup>*</sup></label>
            <input type="password" name="password" class="form-control" required aria-required>
            <p class="help-block error hidden">Ingresá tu contraseña</p>
          </div>

          {{-- <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div> --}}

          {{-- <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div> --}}

          {{-- <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                  </div>
              </div>
          </div> --}}

          <div class="w-2/3 mx-auto mt-8 form-group item-form text-center">
            <button type="submit" class="btn btn-block btn-primary uppercase">
                Inicia sesión
            </button>
          </div>

          <div class="w-2/3 mx-auto form-group item-form text-center">
            <a href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
