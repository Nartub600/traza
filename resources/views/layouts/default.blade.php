<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/estilos.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">
  </head>
  <body>
    <div class="flex flex-col min-h-screen" id="traza">
      @include('layouts.header')

      <main class="flex-1">
        @yield('content')
      </main>

      @include('layouts.footer')
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
  </body>
</html>

