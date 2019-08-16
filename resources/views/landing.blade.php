@extends('layouts.default')

@section('content')
<p>
  <a href="{{ route('usuarios.index') }}">
    Usuarios
  </a>
</p>

<p>
  <a href="{{ route('grupos.index') }}">
    Grupos
  </a>
</p>

<p>
  <a href="{{ route('perfiles.index') }}">
    Perfiles
  </a>
</p>
@endsection
