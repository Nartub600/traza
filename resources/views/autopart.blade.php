@extends('layouts.public')

@section('content')
<div class="flex flex-col items-center pt-4">
  <img src="data:image/png;base64,{{ base64_encode($autopart->qr) }}">

  <h1>{{ $autopart->chas }}</h1>

  <p>Marca: {{ $autopart->brand }}</p>
  <p>Modelo: {{ $autopart->model }}</p>
  <p>Origen: {{ $autopart->origin }}</p>
  <p>Descripción: {{ $autopart->description }}</p>
  <p>Fabricante: {{ $autopart->manufacturer }}</p>
  <p>Importador: {{ $autopart->importer }}</p>
  <p>Razón social: {{ $autopart->business_name }}</p>
  <p>Número de parte: {{ $autopart->part_number }}</p>

  @if ($autopart->pictures)
    <div class="flex flex-wrap">
      @foreach ($autopart->pictures as $picture)
        <img src="{{ $picture }}">
      @endforeach
    </div>
  @endif
</div>
@endsection
