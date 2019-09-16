@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('certificados.index') }}">Certificados</a></li>
    <li class="active">Ver</li>
  </ol>

  <h1>
    Ver Certificado <em>{{ $certificate->number }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-1/2 form-group item-form px-4">
        <label for="number" class="mb-4">Número de certificado <sup>*</sup></label>
        <input type="text" name="number" class="form-control" readonly value="{{ $certificate->number }}">
      </div>

      <div class="w-1/2 form-group item-form px-4">
        <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
        <input type="text" name="cuit" class="form-control" readonly value="{{ $certificate->cuit }}">
      </div>
    </div>

    <table class="table" id="tabla">
      <thead>
        <tr>
          <th>ORDEN</th>
          <th>PRODUCTO</th>
          <th>AUTOPARTE</th>
          <th>DESCRIPCIÓN</th>
          <th>MARCA</th>
          <th>MODELO</th>
          <th>FOTO</th>
          <th>ORIGEN</th>
        </tr>
      </thead>

      <tbody>
        @foreach($certificate->autoparts as $autopart)
        <tr>
          <td class="align-middle">{{ $loop->index + 1 }}</td>
          <td class="align-middle">{{ $autopart->product->name }}</td>
          <td class="align-middle">{{ $autopart->name }}</td>
          <td class="align-middle">{{ $autopart->description }}</td>
          <td class="align-middle">{{ $autopart->brand }}</td>
          <td class="align-middle">{{ $autopart->model }}</td>
          <td class="align-middle"><img class="w-64" src="{{ $autopart->picture }}"></td>
          <td class="align-middle">{{ $autopart->origin }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="flex justify-end">
      <a class="btn btn-success uppercase mr-4" href="{{ route('certificados.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection
