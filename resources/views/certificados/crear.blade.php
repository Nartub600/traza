@extends('layouts.default')

@section('content')
<autopartes inline-template :old-autopartes="{{ json_encode(old('autoparts') ?? []) }}">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('certificados.index') }}">Certificados</a></li>
      <li class="active">Nuevo</li>
    </ol>

    <h1>
      Nuevo Certificado
    </h1>

    <hr class="my-4">

    <div class="bg-white p-4 mb-4" v-cloak>
      <form action="{{ route('certificados.store') }}" method="post">
        @csrf
        {{-- <input type="hidden" name="autoparts[]" v-for="id in autopartesIds" :value="id"> --}}
        {{-- <input type="hidden" name="autoparts" v-model="autopartesJSON"> --}}
        <input
          type="hidden"
          name="autoparts[]"
          v-for="(autoparte, index) in autopartesJSON"
          :value="autoparte"
          :key="`autoparte-${index}`"
        >

        @if ($errors->any())
        <div class="alert alert-danger mx-3 mt-8">
          <h5>Se han producido los siguientes errores:</h5>
          <ol>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ol>
        </div>
        @endif

        <div class="flex flex-wrap -mx-4">
          <div class="w-1/2 form-group item-form px-4">
            <label for="number" class="mb-4">Número de certificado <sup>*</sup></label>
            <input type="text" name="number" class="form-control" required aria-required value="{{ old('number') }}">
            <p class="help-block error hidden">Ingrese el número del certificado</p>
          </div>

          <div class="w-1/2 form-group item-form px-4">
            <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
            <input type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit') }}">
            <p class="help-block error hidden">Ingrese la CUIT</p>
          </div>
        </div>

        <div class="flex justify-end -mx-2">
          <button
            type="button"
            class="btn btn-success uppercase mx-2"
            data-toggle="modal"
            data-target="#crear-autoparte"
          >
            Agregar autoparte
          </button>

          <button type="button" class="btn btn-success uppercase mx-2">
            Cargar Excel
          </button>

          <button type="button" class="btn btn-success uppercase mx-2">
            Vaciar listado
          </button>
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
              <th><i class="fa fa-cog"></i></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(autoparte, index) in autopartes">
              <td>@{{ index }}</td>
              <td>@{{ autoparte.product.name }}</td>
              <td>@{{ autoparte.name }}</td>
              <td>@{{ autoparte.description }}</td>
              <td>@{{ autoparte.brand }}</td>
              <td>@{{ autoparte.model }}</td>
              <td>@{{ autoparte.picture }}</td>
              <td>@{{ autoparte.origin }}</td>
              <td>
                <a href="#" class="btn m-0 p-0">
                  <i class="fa fa-edit"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="flex justify-end">
          <a class="btn btn-success uppercase mr-4" href="{{ route('grupos.index') }}">
            Volver
          </a>

          <button class="btn btn-info uppercase" type="submit">
            Guardar
          </button>
        </div>
      </form>

      <div class="modal fade" id="crear-autoparte" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form ref="autoparteForm" action="{{ route('autopartes.store') }}" @submit.prevent="add">
              @csrf
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
              </div>
              <div class="modal-body">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Producto <sup>*</sup></label>
                    <select name="product" class="form-control" v-model="autoparte.product">
                      <option value="">---</option>
                      @foreach ($products as $product)
                      <option :value="{{ json_encode($product) }}">{{ $product->name }}</option>
                      @endforeach
                    </select>
                    <p class="help-block error hidden">Seleccione el producto</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Autoparte <sup>*</sup></label>
                    <input name="name" type="text" class="form-control" required aria-required v-model="autoparte.name">
                    <p class="help-block error hidden">Ingrese la autoparte</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Descripción <sup>*</sup></label>
                    <input name="description" type="text" class="form-control" required aria-required v-model="autoparte.description">
                    <p class="help-block error hidden">Ingrese la descripción</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Marca <sup>*</sup></label>
                    <input name="brand" type="text" class="form-control" required aria-required v-model="autoparte.brand">
                    <p class="help-block error hidden">Ingrese la marca</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Modelo <sup>*</sup></label>
                    <input name="model" type="text" class="form-control" required aria-required v-model="autoparte.model">
                    <p class="help-block error hidden">Ingrese el modelo</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Origen <sup>*</sup></label>
                    <input name="origin" type="text" class="form-control" required aria-required v-model="autoparte.origin">
                    <p class="help-block error hidden">Ingrese el origen</p>
                  </div>

                  <div class="w-1/2 form-group item-form px-4">
                    <label class="mb-4">Foto <sup>*</sup></label>
                    <input name="picture" type="file" class="form-control">
                    <p class="help-block error hidden">Agregue una foto</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Volver</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</autopartes>
@endsection
