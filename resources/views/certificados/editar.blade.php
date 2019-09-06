@extends('layouts.default')

@section('content')
<autopartes
  inline-template
  :old-autopartes="{{ collect(old('autoparts', [])) }}"
  :products="{{ $products }}"
  :certificate="{{ $certificate }}"
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('certificados.index') }}">Certificados</a></li>
      <li class="active">Editar</li>
    </ol>

    <h1>
      Editar Certificado <em>{{ $certificate->number }}</em>
    </h1>

    <hr class="my-4">

    <div class="bg-white p-4 mb-4" v-cloak>
      <form action="{{ route('certificados.update', $certificate->id) }}" method="post">
        @csrf
        @method('put')

        <template v-for="(autoparte, index) in autopartes">
          <input :key="`${index}-product_id`" type="hidden" :name="`autoparts[${index}][product_id]`" :value="autoparte.product_id">
          <input :key="`${index}-product_name`" type="hidden" :name="`autoparts[${index}][product_name]`" :value="autoparte.product_name">
          <input :key="`${index}-name`" type="hidden" :name="`autoparts[${index}][name]`" :value="autoparte.name">
          <input :key="`${index}-description`" type="hidden" :name="`autoparts[${index}][description]`" :value="autoparte.description">
          <input :key="`${index}-brand`" type="hidden" :name="`autoparts[${index}][brand]`" :value="autoparte.brand">
          <input :key="`${index}-model`" type="hidden" :name="`autoparts[${index}][model]`" :value="autoparte.model">
          <input :key="`${index}-origin`" type="hidden" :name="`autoparts[${index}][origin]`" :value="autoparte.origin">
          <input v-for="picture in autoparte.pictures" :key="picture" type="hidden" :name="`autoparts[${index}][pictures][]`" :value="picture">
        </template>

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
            <input type="text" name="number" class="form-control" required aria-required value="{{ old('number', $certificate->number) }}">
            <p class="help-block error hidden">Ingrese el número del certificado</p>
          </div>

          <div class="w-1/2 form-group item-form px-4">
            <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
            <input type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit', $certificate->cuit) }}">
            <p class="help-block error hidden">Ingrese la CUIT</p>
          </div>
        </div>

        <div class="flex justify-end -mx-2">
          <button
            type="button"
            class="btn btn-success uppercase mx-2"
            @click="add"
          >
            Agregar autoparte
          </button>

          <button type="button" class="btn btn-success uppercase mx-2" @click="($refs.excel.value = null, $refs.excel.click())">
            Cargar Excel
            <input action="{{ route('import.autoparts') }}" class="hidden" type="file" ref="excel" @change="handleAutopartsExcel">
          </button>

          <button @click="clearIndex" type="button" class="btn btn-success uppercase mx-2">
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
              <th>FOTOS</th>
              <th>ORIGEN</th>
              <th><i class="fa fa-cog"></i></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(autoparte, index) in autopartes">
              <td class="align-middle">@{{ index }}</td>
              <td class="align-middle">@{{ autoparte.product_name }}</td>
              <td class="align-middle">@{{ autoparte.name }}</td>
              <td class="align-middle">@{{ autoparte.description }}</td>
              <td class="align-middle">@{{ autoparte.brand }}</td>
              <td class="align-middle">@{{ autoparte.model }}</td>
              <td class="align-middle">
                <div class="swiper-container" :ref="`swiper${index}`">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="picture in autoparte.pictures">
                      <img class="w-64" :src="picture">
                    </div>
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
              </td>
              <td class="align-middle">@{{ autoparte.origin }}</td>
              <td class="align-middle">
                <button type="button" @click="edit(autoparte, index)" class="btn text-azul m-0 p-0">
                  <i class="fa fa-edit"></i>
                </button>
                <button type="button" @click="removeFromIndex(index)" class="btn text-azul m-0 p-0">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="flex justify-end mt-3">
          <a class="btn btn-success uppercase mr-4" href="{{ route('certificados.index') }}">
            Volver
          </a>

          <button class="btn btn-info uppercase" type="submit">
            Guardar
          </button>
        </div>
      </form>

      <autopartes-modal
        v-if="showModal"
        :products="{{ $products }}"
        :editing="editing"
        v-model="autoparte"
        @done="addToIndex"
      >
      </autopartes-modal>
    </div>
  </div>
</autopartes>
@endsection
