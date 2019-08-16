<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/estilos.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">

    <script src="{{ asset('js/scripts.js') }}"></script>
  </head>
  <body>
    <div class="flex flex-col min-h-screen">
      @include('layouts.header')

      <main class="flex-1">
        @yield('content')
      </main>

      @include('layouts.footer')
    </div>
  </body>
</html>

