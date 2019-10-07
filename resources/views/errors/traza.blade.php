<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <script src="{{ asset('js/estilos.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">
  </head>
  <body class="antialiased">
    <div class="flex flex-col min-h-screen" id="traza" v-cloak>
      @include('layouts.header')

      <main class="flex-1 flex flex-col items-center justify-center text-celeste">
        <div class="text-5xl">
          @yield('code')
        </div>

        <div class="text-3xl" style="padding: 10px;">
          @yield('message')
        </div>
      </main>

      @include('layouts.footer')
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
  </body>
</html>
