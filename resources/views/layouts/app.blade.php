<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/estilos.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilos.css') }}">
  </head>
  <body class="antialiased">
    <div id="traza">
      <main class="flex min-h-screen">
        @yield('content')
      </main>
    </div>

    {{-- <script src="{{ asset('js/scripts.js') }}"></script> --}}
  </body>
</html>

