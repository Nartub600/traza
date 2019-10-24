@extends('layouts.default')

@section('content')
<autopartes
  :products="{{ $products }}"
  inline-template
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('licencias.index') }}">Licencias</a></li>
      <li class="active">Ver</li>
    </ol>

    <h1>
      Ver Licencia <em>{{ $certificate->number }}</em>
    </h1>

    <hr class="my-4">

    <div class="bg-white p-4 mb-4">
      <div class="flex flex-wrap -mx-4">
        <div class="w-1/3 form-group item-form px-4">
          <label for="number" class="mb-4">Número de licencia <sup>*</sup></label>
          <input type="text" name="number" class="form-control" readonly value="{{ $certificate->number }}">
        </div>

        <div class="w-1/3 form-group item-form px-4">
          <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
          <input type="text" name="cuit" class="form-control" readonly value="{{ $certificate->cuit }}">
        </div>

        <div class="w-1/3 form-group item-form px-4">
          <label for="documents[licencia]" class="mb-4">Licencia <sup>*</sup></label>
          @if($certificate->files[0])
            <a class="block" href="{{ url($certificate->files[0]['file']) }}">Ver actual</a>
          @else
            <p>Todavía no fue adjuntada</p>
          @endif
        </div>
      </div>

      <table class="table" id="tabla">
        <thead>
          <tr>
            <th>ORDEN</th>
            <th>PRODUCTO</th>
            <th>DESCRIPCIÓN</th>
            <th>MARCA</th>
            <th>MODELO</th>
            {{-- <th>FOTO</th> --}}
            <th>ORIGEN</th>
            <th><i class="fa fa-cog"></i></th>
          </tr>
        </thead>

        <tbody>
          @foreach($certificate->autoparts as $autopart)
          <tr>
            <td class="align-middle">{{ $loop->index + 1 }}</td>
            <td class="align-middle">{{ $autopart->product_string }}</td>
            <td class="align-middle">{{ $autopart->description }}</td>
            <td class="align-middle">{{ $autopart->brand }}</td>
            <td class="align-middle">{{ $autopart->model }}</td>
            {{-- <td class="align-middle"><img class="w-64" src="{{ $autopart->picture }}"></td> --}}
            <td class="align-middle">{{ $autopart->origin }}</td>
            <td>
              <button type="button" @click="view({{$autopart}})" class="btn text-azul m-0 p-0">
                <i class="fa fa-eye"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mt-4 mb-0" href="{{ route('licencias.index') }}">
          Volver
        </a>
      </div>
    </div>

    <autopartes-modal
      v-if="showModal"
      :products="flatProducts"
      :ncm="{{ $ncm }}"
      :editing="editing"
      v-model="autoparte"
      @done="addToIndex"
    >
    </autopartes-modal>
  </div>
</autopartes>
@endsection
