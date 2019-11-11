@extends('layouts.public')

@section('content')
<div class="flex flex-col items-center py-4">
  <img src="data:image/png;base64,{{ base64_encode($lcm->qr) }}">

  <h1>{{ $lcm->chas }}</h1>

  <p>Marca: {{ $lcm->brand }}</p>
  <p>Modelo: {{ $lcm->model }}</p>
  <p>Origen: {{ $lcm->origin }}</p>
  <p>Descripción: {{ $lcm->description }}</p>
  <p>Fabricante: {{ $lcm->manufacturer }}</p>
  <p>Importador: {{ $lcm->importer }}</p>
  <p>Razón social: {{ $lcm->business_name }}</p>

  {{-- @if ($lcm->pictures)
    <div class="flex flex-wrap items-center">
      @foreach ($lcm->physicalPictures as $picture)
        <img class="w-64 mx-2" src="{{ Storage::url($picture['file']) }}">
      @endforeach
    </div>
  @endif --}}
</div>
@endsection
