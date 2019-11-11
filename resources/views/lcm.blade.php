@extends('layouts.public')

@section('content')
<div class="flex flex-col items-center py-4">
  <img src="data:image/png;base64,{{ base64_encode($lcm->qr) }}">

  <h1>{{ $lcm->cape }}</h1>

  <p>Marca: {{ $lcm->brand }}</p>
  <p>Modelo: {{ $lcm->model }}</p>
  <p>Origen: {{ $lcm->country }}</p>
  <p>LCM: {{ $lcm->number }}</p>
  @if($lcm->defeats)
    <p>Reemplaza: {{ $lcm->defeats }}</p>
  @endif
  <p>Tipo: {{ $lcm->type }}</p>
  <p>Fecha de emisión: {{ $lcm->issued_at }}</p>
  <p>Razón social: {{ $lcm->business_name }}</p>
  <p>CUIT: {{ $lcm->cuit }}</p>
  <p>Lugar de Fabricación: {{ $lcm->manufacturing_place }}</p>
  <p>Denominación Comercial: {{ $lcm->commercial_name }}</p>
  <p>Categoría: {{ $lcm->category }}</p>
  <p>Versión: {{ $lcm->version }}</p>

  @if ($lcm->pictures)
    <div class="flex flex-wrap items-center">
      @foreach ($lcm->physicalPictures as $picture)
        <img class="w-64 mx-2" src="{{ Storage::url($picture['file']) }}">
      @endforeach
    </div>
  @endif
</div>
@endsection
